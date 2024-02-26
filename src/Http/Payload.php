<?php

declare(strict_types=1);

namespace OpenBreweryDb\Http;

use Http\Discovery\Psr17Factory;
use Psr\Http\Message\RequestInterface;

/**
 * @internal
 */
final readonly class Payload
{
    /**
     * Creates a new Request value object.
     *
     * @param array<string, mixed> $parameters
     */
    private function __construct(
        private ContentType $contentType,
        private HttpMethod  $method,
        private ResourceUri $uri,
        private array       $parameters = [],
    )
    {
        // ..
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array<string, mixed> $parameters
     */
    public static function list(string $resource, array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = HttpMethod::GET;
        $uri = ResourceUri::list($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array<string, mixed> $parameters
     */
    public static function retrieve(string $resource, string $id, string $suffix = '', array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = HttpMethod::GET;
        $uri = ResourceUri::retrieve($resource, $id, $suffix);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function retrieveResource(string $resource, string $resourceId): self
    {
        $contentType = ContentType::JSON;
        $method = HttpMethod::GET;
        $uri = ResourceUri::retrieveResource($resource, $resourceId);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers, QueryParams $queryParams): RequestInterface
    {
        $psr17Factory = new Psr17Factory();
        $uri = "$baseUri$this->uri";
        $queryParams = [...$queryParams->toArray(), ...$this->parameters];

        if ($queryParams !== []) {
            $uri .= '?' . http_build_query($queryParams);
        }

        $headers = $headers->withContentType($this->contentType);
        $request = $psr17Factory->createRequest($this->method->value, $uri);

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
