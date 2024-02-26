<?php

declare(strict_types=1);

namespace OpenBreweryDb\Contracts\Resources;

use OpenBreweryDb\Responses\Breweries\FindResponse;
use OpenBreweryDb\Responses\Breweries\ListResponse;

interface BreweriesContract
{
    /**
     * Retrieves a brewery based on its UUID.
     *
    * @see https://openbrewerydb.org/documentation#single-brewery
     */
    public function find(string $id): FindResponse;

    /**
     * Retrieves a list of currently documented breweries.
     *
     * @param array<string, string|int|float> $parameters
     *
     * @see https://openbrewerydb.org/documentation#list-breweries
     */
    public function list(array $parameters = []): ListResponse;

    /**
     * Retrieves one or more random breweries.
     *
     * @see https://openbrewerydb.org/documentation#random
     */
    public function random(int $size = 1): ListResponse;
}
