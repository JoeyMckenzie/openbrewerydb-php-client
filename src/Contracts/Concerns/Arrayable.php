<?php

declare(strict_types=1);

namespace OpenBreweryDb\Contracts\Concerns;

/**
 * Provides a contract to allow resources and objects to be displayed as an array representation.
 *
 * @template-covariant TArray of array
 *
 * @internal
 */
interface Arrayable
{
    /**
     * @return TArray
     */
    public function toArray(): array;
}
