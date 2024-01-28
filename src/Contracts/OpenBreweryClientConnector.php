<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Contracts;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal Client connectors are internal implementations of both the default and configurable client, not meant to be used outside the scope of the library.
 */
interface OpenBreweryClientConnector
{
    /**
     * Sends a request to Open Brewery DP and attempts to deserialize the response into the target type.
     *
     * @param  string  $uri  Target URI.
     * @param  string  $type  Target type to deserialize into.
     * @param  array<string, string|int>|null  $query  Optional query parameters.
     * @param  bool  $allowNullable  Flag indicating if the retrieval should capture not found information as null.
     *
     * @throws ClientExceptionInterface
     */
    public function sendAndDeserialize(string $uri, string $type, ?array $query = null, bool $allowNullable = false): mixed;

    /**
     * Sends a request to Open Brewery DB, including optional query parameters.
     *
     * @param  string  $uri  target URI.
     * @param  array<string, string|int>|null  $query  optional query parameters.
     *
     * @throws ClientExceptionInterface
     */
    public function sendRequest(string $uri, ?array $query = null): ResponseInterface;
}
