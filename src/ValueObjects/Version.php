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
    private int $major;

    /**
     * Minor version number, incremented for minor API changes and non-backwards compatibility changes.
     */
    private int $minor;

    /**
     * Patch version number, incremented for bug fixes and documentation updates.
     */
    private int $patch;

    /**
     * Constructs a new version based on the major, minor, and patch of the current release.
     */
    public function __construct()
    {
        $this->major = 0;
        $this->minor = 1;
        $this->patch = 0;
    }

    #[Override]
    public function __toString(): string
    {
        return "$this->major.$this->minor.$this->patch";
    }
}
