<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects;

/**
 * @internal
 */
final readonly class Version implements \Stringable
{
    public function __construct(private int $major, private int $minor, private int $patch)
    {
    }

    public static function from(int $major, int $minor, int $patch): self
    {
        return new self($major, $minor, $patch);
    }

    #[\Override]
    public function __toString(): string
    {
        return "$this->major.$this->minor.$this->patch";
    }
}
