<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

/**
 * Metadata about the current status of Open Brewery DB.
 */
final class BreweriesMeta
{
    /**
     * @var string Current total number of breweries registered with the API.
     */
    public string $total;

    /**
     * @var string Current page default value.
     */
    public string $page;

    /**
     * @var string Current per page default value.
     */
    public string $perPage;
}
