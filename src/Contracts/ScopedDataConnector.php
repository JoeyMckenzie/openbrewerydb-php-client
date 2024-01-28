<?php

namespace OpenBrewery\OpenBrewery\Contracts;

use OpenBrewery\OpenBrewery\Breweries\BreweryClient;

interface ScopedDataConnector
{
    /**
     * Constructs a new brewery client API instance.
     */
    public function breweries(): BreweryClient;
}
