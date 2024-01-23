<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery;

use GuzzleHttp\Exception\GuzzleException;

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
     * Retrieves a list of all available breweries.
     *
     * @return Brewery[] Mapped breweries, empty if none are found.
     *
     * @throws GuzzleException
     */
    public function list(): array
    {
        /** @var Brewery[] $response */
        $response = $this->client->sendAndDeserialize('', '\OpenBrewery\OpenBrewery\Brewery[]');

        return $response;
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
        $response = $this->client->sendAndDeserialize('random', '\OpenBrewery\OpenBrewery\Brewery[]', [
            'size' => $size,
        ]);

        return $response;
    }
}
