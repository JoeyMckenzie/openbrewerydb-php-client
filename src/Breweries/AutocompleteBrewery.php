<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

/**
 * A slim brewery model returning only priority values on the brewery model, useful for dropdowns.
 */
final class AutocompleteBrewery
{
    /**
     * @var string UUID of the brewery.
     */
    public string $id;

    /**
     * @var string Name of the brewery.
     */
    public string $name;
}
