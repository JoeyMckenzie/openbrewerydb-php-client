<?php

declare(strict_types=1);

namespace OpenBreweryDb;

use OpenBreweryDb\ValueObjects\Version;

/**
 * A generic client connector to Open Brewery DB that uses a pre-configured HTTP client.
 * If no client is provided, we'll run auto-discovery to detect the client installed.
 */
final class OpenBreweryDb
{
    /**
     * Creates a new default client instance.
     */
    public static function client(): Client
    {
        $version = Version::current();

        return self::builder()
            ->withHeader('User-Agent', "openbrewerydb-php-client/$version")
            ->build();
    }

    /**
     * Creates a new client builder to configure with custom options.
     */
    public static function builder(): Builder
    {
        return new Builder();
    }

    /**
     * Gets the current version information for the library.
     */
    public function getVersion(): Version
    {
        return Version::current();
    }
}
