<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

/**
 * Backed enum for various brewery types, useful during deserialization.
 */
enum BreweryType: string
{
    /**
     * Represents a microbrewery.
     */
    case MICRO = 'micro';

    /**
     * Represents a nanobrewery.
     */
    case NANO = 'nano';

    /**
     * Represents a regional brewery, typically distributing only within a geographical locality.
     */
    case REGIONAL = 'regional';

    /**
     * Represents a pub-style brewery.
     */
    case BREWPUB = 'brewpub';

    /**
     * Represents a large brewery distributor, usually nationwide and well recognized.
     */
    case LARGE = 'large';

    /**
     * Represents a planned brewery.
     */
    case PLANNING = 'planning';

    /**
     * Represents a bar.
     */
    case BAR = 'bar';

    /**
     * Represents a contracted brewery.
     */
    case CONTRACT = 'contract';

    /**
     * Represents a proprietor brewery.
     */
    case PROPRIETOR = 'proprietor';

    /**
     * Represents a brewery that has closed (F's in the chat...).
     */
    case CLOSED = 'closed';
}
