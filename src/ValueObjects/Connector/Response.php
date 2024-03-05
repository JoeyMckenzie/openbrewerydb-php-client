<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects\Connector;

/**
 * A value object for encapsulating response data generic over an array JSON object.
 * Every typed response object should include the response value object with
 * the arrayable implementation mixed in at the top level.
 *
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
