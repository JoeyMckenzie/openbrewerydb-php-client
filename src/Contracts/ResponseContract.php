<?php

declare(strict_types=1);

namespace OpenBreweryDb\Contracts;

use ArrayAccess;
use OpenBreweryDb\Contracts\Concerns\Arrayable;

/**
 * Response contracts provide a set of methods allowing responses to be interacted with in a PHP array-like manner.
 *
 * @template TArray of array
 *
 * @extends ArrayAccess<key-of<TArray>, value-of<TArray>>
 * @extends Arrayable<TArray>
 *
 * @internal
 */
interface ResponseContract extends Arrayable, ArrayAccess
{
    /**
     * @param  key-of<TArray>  $offset
     */
    public function offsetExists(mixed $offset): bool;

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param  TOffsetKey  $offset
     * @return TArray[TOffsetKey]
     */
    public function offsetGet(mixed $offset): mixed;

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param  TOffsetKey|null  $offset
     * @param TArray[TOffsetKey] $value
     */
    public function offsetSet(mixed $offset, mixed $value): never;

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param  TOffsetKey  $offset
     */
    public function offsetUnset(mixed $offset): never;
}
