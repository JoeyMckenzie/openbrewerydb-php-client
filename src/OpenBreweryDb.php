<?php

declare(strict_types=1);

namespace OpenBreweryDb;

final class OpenBreweryDb
{
    /**
     * Creates a new Open AI Client with the given API token.
     */
    public static function client(): Client
    {
        return self::factory()
            ->withBaseUrl(Client::API_BASE_URL)
            ->withHttpHeader('User-Agent', 'openbrewerydb-php-api-client/0.1.0')
            ->make();
    }

    /**
     * Creates a new factory instance to configure a custom Open AI Client
     */
    public static function factory(): Factory
    {
        return new Factory();
    }
}
