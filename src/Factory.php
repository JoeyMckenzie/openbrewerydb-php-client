<?php

declare(strict_types=1);

namespace OpenBreweryDb;

use Http\Discovery\Psr18ClientDiscovery;
use OpenBreweryDb\Http\BaseUri;
use OpenBreweryDb\Http\Headers;
use OpenBreweryDb\Http\QueryParams;
use OpenBreweryDb\Http\Transporter;
use Psr\Http\Client\ClientInterface;

final class Factory
{
    /**
     * The HTTP client for the requests.
     */
    private ?ClientInterface $httpClient = null;

    /**
     * The base URI for the requests.
     */
    private string $baseUri;

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
     * Sets the base URI for the requests.
     */
    public function withBaseUrl(string $baseUrl): self
    {
        $this->baseUri = $baseUrl;

        return $this;
    }

    /**
     * Adds a custom HTTP header to the requests.
     */
    public function withHttpHeader(string $name, string $value): self
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
    public function make(): Client
    {
        $headers = Headers::create();

        foreach ($this->headers as $name => $value) {
            $headers = $headers->withCustomHeader($name, $value);
        }

        $baseUri = BaseUri::from($this->baseUri);

        $queryParams = QueryParams::create();
        foreach ($this->queryParams as $name => $value) {
            $queryParams = $queryParams->withParam($name, $value);
        }

        $client = $this->httpClient ??= Psr18ClientDiscovery::find();
        $transporter = new Transporter($client, $baseUri, $headers, $queryParams);

        return new Client($transporter);
    }
}
