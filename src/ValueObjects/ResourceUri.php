<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects;

/**
 * @internal
 */
final readonly class ResourceUri
{
    /**
     * Creates a new ResourceUri value object.
     */
    private function __construct(private string $uri)
    {
    }

    /**
     * Creates a new ResourceUri value object that lists the given resource.
     */
    public static function list(string $resource): self
    {
        return new self($resource);
    }

    /**
     * Creates a new ResourceUri value object that retrieves the given resource.
     */
    public static function retrieve(string $resource, string $id): self
    {
        return new self("$resource/$id");
    }

    public function __toString(): string
    {
        return $this->uri;
    }
}
