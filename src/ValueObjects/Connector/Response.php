<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects\Connector;

/**
 * @template-covariant TData of array
 *
 * @internal
 */
final readonly class Response
{
    /**
     * Creates a new Response value object.
     *
     * @param  TData  $data
     */
    private function __construct(private mixed $data)
    {
    }

    /**
     * Creates a new Response value object from the given data and meta information.
     *
     * @param  TData  $attributes
     * @return Response<TData>
     */
    public static function from(array $attributes): self
    {
        return new self($attributes);
    }

    /**
     * Returns the response data.
     *
     * @return TData
     */
    public function data(): mixed
    {
        return $this->data;
    }
}
