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
    private int $major;

    private int $minor;

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
