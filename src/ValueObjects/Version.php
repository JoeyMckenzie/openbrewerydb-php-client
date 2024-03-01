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
     * Major version number, incremented on language upgrades, refactors, or backwards compatibility breaking changes.
     */
    public int $major;

    /**
     * Minor version number, incremented for minor API changes and non-backwards compatibility changes.
     */
    public int $minor;

    /**
     * Patch version number, incremented for bug fixes and documentation updates.
     */
    public int $patch;

    /**
     * Constructs a new version based on the major, minor, and patch of the current release.
     */
    public function __construct(int $major, int $minor, int $patch)
    {
        $this->major = $major;
        $this->minor = $minor;
        $this->patch = $patch;
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
