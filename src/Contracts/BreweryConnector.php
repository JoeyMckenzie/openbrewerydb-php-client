<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use OpenBrewery\OpenBrewery\Breweries\AutocompleteBrewery;
use OpenBrewery\OpenBrewery\Breweries\BreweriesMeta;
use OpenBrewery\OpenBrewery\Breweries\Brewery;
use OpenBrewery\OpenBrewery\Breweries\BreweryType;
use OpenBrewery\OpenBrewery\Breweries\SortBy;
use OpenBrewery\OpenBrewery\Breweries\SortOrder;
use OpenBrewery\OpenBrewery\OpenBrewery;

/**
 * Defines the API contract between the calling client and the Open Brewery DB REST API.
 */
interface BreweryConnector
{
    /**
     * Finds a single brewery based on the UUID.
     *
     * @param  string  $uuid  Open Brewery DB generated UUID.
     * @return Brewery|null Mapped brewery if one is found, else null.
     *
     * @throws GuzzleException
     */
    public function find(string $uuid): ?Brewery;

    /**
     * Retrieves a list of breweries based on optional search criteria.
     * Breweries are paginated, with a maximum page value of 50.
     *
     * @param  string[]|null  $ids  List of brewery UUIDs.
     * @param  string|null  $name  Name of the brewery, acting as a needle in the haystack.
     * @param  string|null  $state  State breweries are located in.
     * @param  string|null  $city  City breweries are located in.
     * @param  string|null  $postalCode  Zip code breweries are located in.
     * @param  BreweryType|null  $type  Brewery type, based on the allowed available types.
     * @param  SortBy|SortBy[]|null  $sortBy  Field(s) to sort by for the listed breweries.
     * @param  SortOrder  $sortOrder  Sort order for the selected fields, defaults to ascending order.
     * @param  int  $page  Page of the list results.
     * @param  int  $perPage  Number of breweries to include per page.
     * @return Brewery[] List of breweries, if any satisfied the list search criteria.
     *
     * @throws GuzzleException
     */
    public function list(
        ?array $ids = null,
        ?string $name = null,
        ?string $state = null,
        ?string $city = null,
        ?string $postalCode = null,
        ?float $latitude = null,
        ?float $longitude = null,
        ?BreweryType $type = null,
        SortBy|array|null $sortBy = null,
        SortOrder $sortOrder = SortOrder::ASC,
        int $page = 1,
        int $perPage = OpenBrewery::DEFAULT_PER_PAGE,
    ): array;

    /**
     * Retrieves one or more randomly selected breweries.
     *
     * @return Brewery[] Mapped breweries.
     *
     * @throws GuzzleException
     */
    public function random(int $size = 1): array;

    /**
     * Searches for breweries by name.
     *
     * @param  string  $name  Name of the brewery, used as the haystack needle.
     * @param  int  $perPage  Optional number of results per page.
     * @return Brewery[] List of breweries containing the name search term.
     *
     * @throws GuzzleException
     */
    public function search(string $name, int $perPage = OpenBrewery::DEFAULT_PER_PAGE): array;

    /**
     * Searches for breweries by name, though only returning the ID and name of the brewery.
     *
     * @param  string  $name  Name of the brewery, used as the haystack needle.
     * @return AutocompleteBrewery[] List of breweries containing the name search term.
     *
     * @throws GuzzleException
     */
    public function autocomplete(string $name): array;

    /**
     * Retrieves metadata containing the number of breweries and default API values.
     *
     * @param  string|null  $country  Optional country to retrieve metadata.
     * @param  BreweryType|null  $type  Optional brewery type.
     * @return BreweriesMeta Metadata about breweries.
     *
     * @throws GuzzleException
     */
    public function meta(?string $country = null, ?BreweryType $type = null): BreweriesMeta;
}
