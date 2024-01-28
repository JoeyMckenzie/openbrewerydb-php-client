<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Contracts;

use OpenBrewery\OpenBrewery\Breweries\BreweryClient;

/**
 * A set of API connectors for the various datasets Open Brewery DB supports. As of now,
 * breweries are only supported, though there may be other beverage APIs we can tap into.
 */
interface ScopedApiConnector
{
    /**
     * Provides a connector to the brewery API.
     */
    public function breweries(): BreweryClient;
}
