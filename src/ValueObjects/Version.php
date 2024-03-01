<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects;

use Override;
use Stringable;

/**
 * A version value object containing version information based on the current Packagist released version.
 *
 * @internal
 */
final readonly class Version implements Stringable
{
    /**
     * Constructs a new version based on the major, minor, and patch of the current release.
     *
     * @param  int  $major  Major version number, incremented on language upgrades, refactors, or backwards compatibility breaking changes.
     * @param  int  $minor  Minor version number, incremented for minor API changes and non-backwards compatibility changes.
     * @param  int  $patch  Patch version number, incremented for bug fixes and documentation updates.
     */
    public function __construct(
        public int $major,
        public int $minor,
        public int $patch
    ) {
    }

    /**
     * Constructs a current version object.
     */
    public static function current(): self
    {
        return new self(0, 6, 0);
    }

    #[Override]
    public function __toString(): string
    {
        return "$this->major.$this->minor.$this->patch";
    }
}
