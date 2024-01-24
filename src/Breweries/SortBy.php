<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

/**
 * Represents value available for sorting. While most fields on the brewer model
 * are available for sorting, most are left out. Should the need arise
 * for other sortable fields, add them here.
 */
enum SortBy: string
{
    /**
     * Represents sorting by the alphabetic name of the brewery.
     */
    case NAME = 'name';

    /**
     * Represents sorting by the alphabetic name of the brewery.
     */
    case BREWERY_TYPE = 'type';

    /**
     * Represents sorting by the city the brewery is located in.
     */
    case CITY = 'city';

    /**
     * Represents sorting by the state the brewery is located in.
     */
    case STATE = 'state';

    /**
     * Represents sorting by the country the brewery is located in.
     */
    case COUNTRY = 'country';
}
