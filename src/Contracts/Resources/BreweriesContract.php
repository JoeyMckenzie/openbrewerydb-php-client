<?php

declare(strict_types=1);

namespace OpenBreweryDb\Contracts\Resources;

use OpenBreweryDb\Client;
use OpenBreweryDb\Responses\Breweries\AutocompleteResponse;
use OpenBreweryDb\Responses\Breweries\FindResponse;
use OpenBreweryDb\Responses\Breweries\ListResponse;
use OpenBreweryDb\Responses\Breweries\MetadataResponse;

/**
 * A top-level contract for interacting with Open Brewery DB's breweries as an HTTP resource.
 */
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
     * @param  array<string, string|int|float>  $parameters
     *
     * @see https://openbrewerydb.org/documentation#search-breweries
     */
    public function list(array $parameters = []): ListResponse;

    /**
     * Retrieves one or more random breweries.
     *
     * @see https://openbrewerydb.org/documentation#random
     */
    public function random(int $size = 1): ListResponse;

    /**
     * Searches for breweries that meet the query criteria.
     *
     * @see https://openbrewerydb.org/documentation#list-breweries
     */
    public function search(string $query, int $perPage = Client::PER_PAGE): ListResponse;

    /**
     * Lists breweries with only ID and name based on the query criteria, useful for drop down lists and the like.
     *
     * @see https://openbrewerydb.org/documentation#autocomplete
     */
    public function autocomplete(string $query): AutocompleteResponse;

    /**
     * Lists metadata about breweries based on the optional query criteria.
     *
     * @param  array<string, string|int|float>  $parameters
     *
     * @see https://openbrewerydb.org/documentation#autocomplete
     */
    public function metadata(array $parameters = []): MetadataResponse;
}
