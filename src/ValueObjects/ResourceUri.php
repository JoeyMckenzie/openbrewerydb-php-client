<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects;

use Override;
use Stringable;

/**
 * A value object for representing the resource endpoint for a request.
 *
 * @internal
 */
final readonly class ResourceUri implements Stringable
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
    public static function list(string $resource, ?string $suffix = null): self
    {
        $uri = isset($suffix)
            ? "$resource/$suffix"
            : $resource;

        return new self($uri);
    }

    /**
     * Creates a new resource URI value object that retrieves the given resource.
     */
    public static function retrieve(string $resource, string $id): self
    {
        return new self("$resource/$id");
    }

    #[Override]
    public function __toString(): string
    {
        return $this->uri;
    }
}
