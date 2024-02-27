<?php

declare(strict_types=1);

namespace OpenBreweryDb;

use OpenBreweryDb\Contracts\Resources\BreweriesContract;
use OpenBreweryDb\Contracts\TransporterContract;
use OpenBreweryDb\Resources\Breweries;

/**
 * The primary client for connecting to Open Brewery DB's API containing all connections to the available resources.
 */
final readonly class Client
{
    /**
     * The base URL for Open Brewery DB API.
     */
    public const string API_BASE_URL = 'https://api.openbrewerydb.org';

    /**
     * The default pagination limit for paginated responses.
     */
    public const int PER_PAGE = 50;

    /**
     * The default user agent, will include the current library version.
     */
    public const string USER_AGENT = 'openbrewerydb-php-api-client/0.6.0';

    /**
     * Creates a client instance with the provided client transport abstraction.
     */
    public function __construct(private TransporterContract $transporter)
    {
    }

    /**
     * A resource gateway to the various brewery retrieval options available on the API.
     *
     * @see https://openbrewerydb.org/documentation
     */
    public function breweries(): BreweriesContract
    {
        return new Breweries($this->transporter);
    }
}
