<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use OpenBrewery\OpenBrewery\Breweries\BreweryClient;
use Psr\Http\Message\ResponseInterface;

interface ClientConnector
{
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
    public function sendAndDeserialize(string $uri, string $type, ?array $query = null, bool $allowNullable = false): mixed;

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
    public function sendRequest(string $uri, ?array $query = null): ResponseInterface;

    /**
     * Constructs a new brewery client API instance.
     */
    public function breweries(): BreweryClient;
}
