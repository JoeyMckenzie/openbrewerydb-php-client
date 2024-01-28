<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use OpenBrewery\OpenBrewery\Breweries\BreweryClient;
use OpenBrewery\OpenBrewery\Contracts\OpenBreweryClientConnector;
use OpenBrewery\OpenBrewery\Contracts\ScopedApiConnector;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * A top-level Open Brewery DB client encompassing child API connectors and an internal HTTP client.
 */
final class OpenBreweryClient implements OpenBreweryClientConnector, ScopedApiConnector
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

    /**
     * Sends a request to Open Brewery DP and attempts to deserialize the response into the target type.
     *
     * @param  string  $uri  Target URI.
     * @param  string  $type  Target type to deserialize into.
     * @param  array<string, string|int>|null  $query  Optional query parameters.
     * @param  bool  $allowNullable  Flag indicating if the retrieval should capture not found information as null.
     *
     * @throws GuzzleException
     *
     * @internal Only used by internally, do not use outside of library context as these methods are subject to change.
     */
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

    /**
     * Sends a request to Open Brewery DB, including optional query parameters.
     *
     * @param  string  $uri  target URI.
     * @param  array<string, string|int>|null  $query  optional query parameters.
     *
     * @throws GuzzleException
     *
     * @internal Only used by internally, do not use outside of library context as these methods are subject to change.
     */
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

    /**
     * Constructs a new brewery client API instance.
     */
    public function breweries(): BreweryClient
    {
        $this->breweryClient ??= new BreweryClient($this);

        return $this->breweryClient;
    }
}
