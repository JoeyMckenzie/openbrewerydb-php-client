<?php

declare(strict_types=1);

namespace OpenBreweryDb\Contracts\Concerns;

/**
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
