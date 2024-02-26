<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects;

use Http\Discovery\Psr17Factory;
use OpenBreweryDb\Http\HttpMethod;
use OpenBreweryDb\Http\MediaType;
use OpenBreweryDb\ValueObjects\Transporter\BaseUri;
use OpenBreweryDb\ValueObjects\Transporter\Headers;
use OpenBreweryDb\ValueObjects\Transporter\QueryParams;
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
        private MediaType   $contentType,
        private HttpMethod  $method,
        private ResourceUri $uri,
        private array       $parameters = [],
    ) {
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array<string, mixed> $parameters
     */
    public static function list(string $resource, array $parameters = []): self
    {
        $contentType = MediaType::JSON;
        $method = HttpMethod::GET;
        $uri = ResourceUri::list($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array<string, mixed> $parameters
     */
    public static function retrieve(string $resource, string $id, array $parameters = []): self
    {
        $contentType = MediaType::JSON;
        $method = HttpMethod::GET;
        $uri = ResourceUri::retrieve($resource, $id);

        return new self($contentType, $method, $uri, $parameters);
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

        $headers = $headers->withAccept($this->contentType);
        $request = $psr17Factory->createRequest($this->method->value, $uri);

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
