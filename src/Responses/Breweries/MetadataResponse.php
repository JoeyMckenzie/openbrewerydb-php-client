<?php

declare(strict_types=1);

namespace OpenBreweryDb\Responses\Breweries;

use OpenBreweryDb\Contracts\ResponseContract;
use OpenBreweryDb\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array<int, array{total: string, page: string, per_page: string}>>
 */
final readonly class MetadataResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array<int, array{total: string, page: string, per_page: string}>>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, array{total: string, page: string, per_page: string}>  $data
     */
    private function __construct(public array $data)
    {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array<int, array{total: string, page: string, per_page: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes);
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function toArray(): array
    {
        return $this->data;
    }
}
