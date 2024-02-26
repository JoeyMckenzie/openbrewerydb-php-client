<?php

declare(strict_types=1);

namespace OpenBreweryDb;

use OpenBreweryDb\Contracts\Resources\BreweriesContract;
use OpenBreweryDb\Contracts\TransporterContract;
use OpenBreweryDb\Resources\Breweries;

final class Client
{
    /**
     * The base URL for Open Brewery DB API.
     */
    public const string API_BASE_URL = 'https://api.openbrewerydb.org';

    /**
     * The default pagination limit for paginated responses.
     */
    public const int DEFAULT_PER_PAGE = 50;

    public const string DEFAULT_USER_AGENT = 'openbrewerydb-php-api-client/0.1';

    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
    }

    /**
     * Given a prompt, the model will return one or more predicted completions, and can also return the probabilities
     * of alternative tokens at each position.
     *
     * @see https://openbrewerydb.org/documentation
     */
    public function breweries(): BreweriesContract
    {
        return new Breweries($this->transporter);
    }
}
