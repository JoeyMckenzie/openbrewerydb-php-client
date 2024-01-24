<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

use GuzzleHttp\Exception\GuzzleException;
use OpenBrewery\OpenBrewery\OpenBreweryClient;

/**
 * An client instance for collecting data from the various brewery endpoints.
 */
final readonly class BreweryClient
{
    public function __construct(private OpenBreweryClient $client)
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
     * @param  string[]|null  $ids  asdf
     * @param  string|null  $name  asdf
     * @param  string|null  $state  asdf
     * @param  string|null  $city  asdf
     * @param  string|null  $postalCode  asdf
     * @param  BreweryType|null  $type  asdf
     * @param  SortBy|SortBy[]|null  $sortBy  asdf
     * @param  SortOrder  $sortOrder  asdf
     * @param  int  $page  asdf
     * @param  int  $perPage  asdf
     * @return Brewery[]
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
        int $perPage = 50,
    ): array {
        /** @var array<string, string|int> $queryParams */
        $queryParams = [
            'by_city' => $city,
            'by_ids' => $ids,
            'by_name' => $name,
            'by_state' => $state,
            'by_postal' => $postalCode,
            'by_type' => $type?->value,
            'by_dist' => self::getLatLongQueryStringValue($latitude, $longitude),
            'page' => $page,
            'per_page' => $perPage,
            'sort' => self::getSortByQueryStringvalue($sortBy, $sortOrder),
        ];

        $queryParams = array_filter($queryParams);

        /** @var Brewery[] $response */
        $response = $this->client->sendAndDeserialize('', '\OpenBrewery\OpenBrewery\Breweries\Brewery[]', $queryParams);

        return $response;
    }

    private static function getLatLongQueryStringValue(?float $latitude, ?float $longitude): ?string
    {
        if (is_null($latitude) || is_null($longitude)) {
            return null;
        }

        return "$latitude,$longitude";
    }

    /**
     * @param  SortBy|SortBy[]|null  $sortBy
     */
    private static function getSortByQueryStringvalue(SortBy|array|null $sortBy, SortOrder $sortOrder): ?string
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
}
