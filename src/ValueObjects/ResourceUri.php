<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects;

/**
 * @internal
 */
final readonly class ResourceUri implements \Stringable
{
    /**
     * Creates a new resource URI value object.
     */
    private function __construct(private string $uri)
    {
    }

    /**
     * Creates a new resource URI value object that lists the given resource.
     */
    public static function list(string $resource, string $suffix = ''): self
    {
        $uri = $suffix === '' || $suffix === '0'
            ? $resource
            : "$resource/$suffix";

        return new self($uri);
    }

    /**
     * Creates a new resource URI value object that retrieves the given resource.
     */
    public static function retrieve(string $resource, string $id): self
    {
        return new self("$resource/$id");
    }

    #[\Override]
    public function __toString(): string
    {
        return $this->uri;
    }
}
