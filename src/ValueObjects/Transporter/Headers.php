<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects\Transporter;

use OpenBreweryDb\Enums\MediaType;

/**
 * @internal
 */
final readonly class Headers
{
    /**
     * Creates a new Headers value object.
     *
     * @param  array<string, string>  $headers
     */
    private function __construct(private array $headers)
    {
    }

    /**
     * Creates a new Headers value object
     */
    public static function create(): self
    {
        return new self([]);
    }

    /**
     * Creates a new Headers value object, with the given content type, and the existing headers.
     */
    public function withAccept(MediaType $mediaType, string $suffix = ''): self
    {
        return new self([
            ...$this->headers,
            'Accept' => $mediaType->value.$suffix,
        ]);
    }

    /**
     * Creates a new Headers value object, with the newly added header, and the existing headers.
     */
    public function withCustomHeader(string $name, string $value): self
    {
        return new self([
            ...$this->headers,
            $name => $value,
        ]);
    }

    /**
     * @return array<string, string> $headers
     */
    public function toArray(): array
    {
        return $this->headers;
    }
}
