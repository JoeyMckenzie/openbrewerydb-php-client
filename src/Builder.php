<?php

declare(strict_types=1);

namespace OpenBreweryDb;

use Http\Discovery\Psr18ClientDiscovery;
use OpenBreweryDb\Http\Connector;
use OpenBreweryDb\ValueObjects\Connector\BaseUri;
use OpenBreweryDb\ValueObjects\Connector\Headers;
use OpenBreweryDb\ValueObjects\Connector\QueryParams;
use Psr\Http\Client\ClientInterface;

/**
 * A client builder for configuring the API connector to Open Brewery DB.
 */
final class Builder
{
    /**
     * The HTTP client for the requests.
     */
    private ?ClientInterface $httpClient = null;

    /**
     * The HTTP headers for the requests.
     *
     * @var array<string, string>
     */
    private array $headers = [];

    /**
     * The query parameters for the requests.
     *
     * @var array<string, string|int>
     */
    private array $queryParams = [];

    /**
     * Sets the HTTP client for the requests. If no client is provided the
     * factory will try to find one using PSR-18 HTTP Client Discovery.
     */
    public function withHttpClient(ClientInterface $client): self
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * Adds a custom header to the requests.
     */
    public function withHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Adds a custom query parameter to the request url.
     */
    public function withQueryParam(string $name, string $value): self
    {
        $this->queryParams[$name] = $value;

        return $this;
    }

    /**
     * Creates a new Open Brewery DB Client.
     */
    public function build(): Client
    {
        $headers = Headers::create();

        foreach ($this->headers as $name => $value) {
            $headers = $headers->withCustomHeader($name, $value);
        }

        $baseUri = BaseUri::from(Client::API_BASE_URL);
        $queryParams = QueryParams::create();

        foreach ($this->queryParams as $name => $value) {
            $queryParams = $queryParams->withParam($name, $value);
        }

        $client = $this->httpClient ??= Psr18ClientDiscovery::find();
        $connector = new Connector($client, $baseUri, $headers, $queryParams);

        return new Client($connector);
    }
}
