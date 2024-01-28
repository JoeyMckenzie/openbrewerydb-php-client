<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery;

use GuzzleHttp\Client;
use OpenBrewery\OpenBrewery\Breweries\BreweryClient;
use OpenBrewery\OpenBrewery\Contracts\ScopedApiConnector;

/**
 * A top-level Open Brewery DB client encompassing child API connectors and an internal HTTP client.
 */
final class OpenBreweryClient implements ScopedApiConnector
{
    /**
     * @var BreweryClient|null Internal brewery client, accessed through the public API;
     */
    private ?BreweryClient $breweryClient;

    private InternalHttpClient $httpClient;

    public function __construct(float $timeout = OpenBrewery::DEFAULT_TIMEOUT_SECONDS)
    {
        $serializer = new OpenBreweryClientSerializer();
        $client = new Client([
            'base_uri' => OpenBrewery::API_BASE_URL,
            'timeout' => $timeout,
        ]);
        $this->httpClient = new InternalHttpClient($serializer->serializer, $client);
    }

    /**
     * Constructs a new brewery client API instance.
     */
    public function breweries(): BreweryClient
    {
        $this->breweryClient ??= new BreweryClient($this->httpClient);

        return $this->breweryClient;
    }
}
