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
            ->withHttpHeader('User-Agent', 'assistants=v1')
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
