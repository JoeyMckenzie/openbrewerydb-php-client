<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use OpenBrewery\OpenBrewery\Breweries\BreweryClient;
use OpenBrewery\OpenBrewery\Contracts\OpenBreweryClientConnector;
use OpenBrewery\OpenBrewery\Contracts\ScopedDataConnector;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * A top-level Open Brewery DB client that uses Guzzle internally for API calls.
 */
final class OpenBreweryClient implements OpenBreweryClientConnector, ScopedDataConnector
{
    /**
     * @var Client Internal Guzzle HTTP client instance, configurable based on options.
     */
    private readonly Client $client;

    /**
     * @var Serializer Internal serializer for marshalling responses.
     */
    private readonly Serializer $serializer;

    /**
     * @var BreweryClient|null Internal brewery client, accessed through the public API;
     */
    private ?BreweryClient $breweryClient;

    public function __construct(float $timeout = OpenBrewery::DEFAULT_TIMEOUT_SECONDS)
    {
        $clientSerializer = new OpenBreweryClientSerializer;
        $this->serializer = $clientSerializer->serializer;
        $this->client = new Client([
            'base_uri' => OpenBrewery::API_BASE_URL,
            'timeout' => $timeout,
        ]);
    }

    public function sendAndDeserialize(string $uri, string $type, ?array $query = null, bool $allowNullable = false): mixed
    {
        try {
            $response = self::sendRequest($uri, $query);
            $body = $response->getBody()->getContents();

            return $this->serializer->deserialize($body, $type, 'json');
        } catch (ClientException $e) {
            $code = $e->getCode();

            if ($allowNullable && $code == 404) {
                return null;
            }

            throw $e;
        }
    }

    public function sendRequest(string $uri, ?array $query = null): ResponseInterface
    {
        $requestOptions = [
            'headers' => [
                'user-agent' => 'openbrewerydb-php-api',
            ],
        ];

        if (isset($query)) {
            $requestOptions['query'] = $query;
        }

        $url = '/v1/breweries/'.$uri;

        return $this->client->get($url, $requestOptions);
    }

    public function breweries(): BreweryClient
    {
        $this->breweryClient ??= new BreweryClient($this);

        return $this->breweryClient;
    }
}
