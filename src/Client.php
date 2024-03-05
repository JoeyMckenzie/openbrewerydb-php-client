<?php

declare(strict_types=1);

namespace OpenBreweryDb;

use OpenBreweryDb\Contracts\ConnectorContract;
use OpenBreweryDb\Contracts\Resources\BreweriesContract;
use OpenBreweryDb\Resources\Breweries;

/**
 * The primary client gateway for connecting to Open Brewery DB's API containing all connections to the available resources.
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
     * Creates a client instance with the provided client transport abstraction.
     */
    public function __construct(private ConnectorContract $connector)
    {
    }

    /**
     * Resource gateway to the various brewery retrieval options available on the API.
     *
     * @see https://openbrewerydb.org/documentation
     */
    public function breweries(): BreweriesContract
    {
        return new Breweries($this->connector);
    }
}
