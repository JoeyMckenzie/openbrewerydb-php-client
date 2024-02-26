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
        return self::builder()
            ->withBaseUrl(Client::API_BASE_URL)
            ->withHttpHeader('User-Agent', Client::USER_AGENT)
            ->build();
    }

    /**
     * Creates a new factory instance to configure a custom Open AI Client
     */
    public static function builder(): Builder
    {
        return new Builder();
    }
}
