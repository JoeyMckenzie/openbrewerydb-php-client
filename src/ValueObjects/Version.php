<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects;

use Override;
use Stringable;

/**
 * A version value object containing version information based on the current Packagist released version.
 */
final readonly class Version implements Stringable
{
    /**
     * Major version number, incremented on language upgrades, refactors, or backwards compatibility breaking changes.
     */
    private const int MAJOR = 0;

    /**
     * Minor version number, incremented for minor API changes and non-backwards compatibility changes.
     */
    private const int MINOR = 8;

    /**
     * Patch version number, incremented for bug fixes and documentation updates.
     */
    private const int PATCH = 0;

    #[Override]
    public function __toString(): string
    {
        return self::MAJOR.'.'.self::MINOR.'.'.self::PATCH;
    }

    /**
     * Constructs a new version based on the major, minor, and patch of the current release.
     */
    public static function current(): string
    {
        return (string) new self();
    }
}
