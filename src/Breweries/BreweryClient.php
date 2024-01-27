<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

use GuzzleHttp\Exception\GuzzleException;
use OpenBrewery\OpenBrewery\Contracts\ClientConnector;
use OpenBrewery\OpenBrewery\OpenBrewery;

/**
 * A client instance for collecting data from the various brewery endpoints.
 */
final readonly class BreweryClient
{
    public function __construct(private ClientConnector $client)
    {
    }

    /**
     * Finds a single brewery based on the UUID.
     *
     * @param  string  $uuid  Open Brewery DB generated UUID.
     * @return Brewery|null Mapped brewery if one is found, else null.
     *
     * @throws GuzzleException
     */
    public function find(string $uuid): ?Brewery
    {
        /** @var Brewery $response */
        $response = $this->client->sendAndDeserialize($uuid, Brewery::class, allowNullable: true);

        return $response;
    }

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
    ): array {
        /** @var array<string, string|int> $queryParams */
        $queryParams = [
            'by_city' => $city,
            'by_ids' => $ids,
            'by_name' => $name,
            'by_state' => $state,
            'by_postal' => $postalCode,
            'by_type' => $type?->value,
            'by_dist' => self::getDistanceQueryStringValue($latitude, $longitude),
            'page' => $page,
            'per_page' => $perPage,
            'sort' => self::getSortByQueryStringValue($sortBy, $sortOrder),
        ];

        // We'll purge any null-valued query params
        $queryParams = array_filter($queryParams);

        /** @var Brewery[] $response */
        $response = $this->client->sendAndDeserialize('', '\OpenBrewery\OpenBrewery\Breweries\Brewery[]', $queryParams);

        return $response;
    }

    /**
     * Constructs the distance query parameter field as a concatenated pair containing the
     * latitude and longitude, if both values are validly provided.
     */
    private static function getDistanceQueryStringValue(?float $latitude, ?float $longitude): ?string
    {
        if (is_null($latitude) || is_null($longitude)) {
            return null;
        }

        return "$latitude,$longitude";
    }

    /**
     * Constructs the sort by field query parameter, which may contain one or many sort fields.
     * The constructed query parameter will be a concatenated list of the sort fields
     * followed by the sort precedence, defaulting to ascending sorting.
     *
     * @param  SortBy|SortBy[]|null  $sortBy
     */
    private static function getSortByQueryStringValue(SortBy|array|null $sortBy, SortOrder $sortOrder): ?string
    {
        if (is_null($sortBy)) {
            return null;
        }

        $sortByValues = is_array($sortBy)
            ? collect($sortBy)->map(fn (SortBy $sortBy) => $sortBy->value)->join(',')
            : $sortBy->value;

        return "$sortByValues:$sortOrder->value";
    }

    /**
     * Retrieves one or more randomly selected breweries.
     *
     * @return Brewery[] Mapped breweries.
     *
     * @throws GuzzleException
     */
    public function random(int $size = 1): array
    {
        /** @var Brewery[] $response */
        $response = $this->client->sendAndDeserialize('random', '\OpenBrewery\OpenBrewery\Breweries\Brewery[]', [
            'size' => $size,
        ]);

        return $response;
    }

    /**
     * Searches for breweries by name.
     *
     * @param  string  $name  Name of the brewery, used as the haystack needle.
     * @param  int  $perPage  Optional number of results per page.
     * @return Brewery[] List of breweries containing the name search term.
     *
     * @throws GuzzleException
     */
    public function search(string $name, int $perPage = OpenBrewery::DEFAULT_PER_PAGE): array
    {
        $queryParams = [
            'query' => $name,
            'per_page' => $perPage,
        ];

        /** @var Brewery[] $response */
        $response = $this->client->sendAndDeserialize('search', '\OpenBrewery\OpenBrewery\Breweries\Brewery[]', $queryParams);

        return $response;
    }

    /**
     * Searches for breweries by name, though only returning the ID and name of the brewery.
     *
     * @param  string  $name  Name of the brewery, used as the haystack needle.
     * @return AutocompleteBrewery[] List of breweries containing the name search term.
     *
     * @throws GuzzleException
     */
    public function autocomplete(string $name): array
    {
        $queryParams = [
            'query' => $name,
        ];

        /** @var Brewery[] $response */
        $response = $this->client->sendAndDeserialize('autocomplete', '\OpenBrewery\OpenBrewery\Breweries\AutocompleteBrewery[]', $queryParams);

        return $response;
    }

    /**
     * Retrieves metadata containing the number of breweries and default API values.
     *
     * @param  string|null  $country  Optional country to retrieve metadata.
     * @param  BreweryType|null  $type  Optional brewery type.
     * @return BreweriesMeta Metadata about breweries.
     *
     * @throws GuzzleException
     */
    public function meta(?string $country = null, ?BreweryType $type = null): BreweriesMeta
    {
        $queryParams = [
            'by_country' => $country,
            'by_type' => $type?->value,
        ];

        $queryParams = array_filter($queryParams);

        /** @var BreweriesMeta $response */
        $response = $this->client->sendAndDeserialize('meta', BreweriesMeta::class, $queryParams);

        return $response;
    }
}
