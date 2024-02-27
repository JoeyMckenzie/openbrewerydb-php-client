<?php

declare(strict_types=1);

namespace OpenBreweryDb\Responses\Concerns;

use BadMethodCallException;
use OpenBreweryDb\ValueObjects\Connector\Response;

/**
 * Allows API responses to be treated as arrays, allowing for access through an index to check for properties.
 *
 * @template-covariant TArray of array
 *
 * @mixin Response<TArray>
 *
 * @internal
 */
trait ArrayAccessible
{
    /**
     * {@inheritDoc}
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->toArray()[$offset];
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet(mixed $offset, mixed $value): never
    {
        throw new BadMethodCallException('Responses are immutable. Values are not allowed to be set on responses.');
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset(mixed $offset): never
    {
        throw new BadMethodCallException('Responses are immutable. Values are not allowed to be removed on responses.');
    }
}
