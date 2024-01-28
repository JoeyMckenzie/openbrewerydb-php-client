<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

use OpenBrewery\OpenBrewery\Contracts\BreweryConnector;
use OpenBrewery\OpenBrewery\Contracts\OpenBreweryClientConnector;
use OpenBrewery\OpenBrewery\OpenBrewery;

final readonly class BreweryClient implements BreweryConnector
{
    public function __construct(private OpenBreweryClientConnector $client)
    {
    }

    public function find(string $uuid): ?Brewery
    {
        /** @var Brewery $response */
        $response = $this->client->sendAndDeserialize($uuid, Brewery::class, allowNullable: true);

        return $response;
    }

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

    public function random(int $size = 1): array
    {
        /** @var Brewery[] $response */
        $response = $this->client->sendAndDeserialize('random', '\OpenBrewery\OpenBrewery\Breweries\Brewery[]', [
            'size' => $size,
        ]);

        return $response;
    }

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

    public function autocomplete(string $name): array
    {
        $queryParams = [
            'query' => $name,
        ];

        /** @var Brewery[] $response */
        $response = $this->client->sendAndDeserialize('autocomplete', '\OpenBrewery\OpenBrewery\Breweries\AutocompleteBrewery[]', $queryParams);

        return $response;
    }

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
