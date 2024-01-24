<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

/**
 * Represents sort order for list search operations, usually coupled with available sort fields.
 */
enum SortOrder: string
{
    /**
     * Represents sorting field types by ascending value, if omitted will be the default.
     */
    case ASC = 'asc';

    /**
     * Represents sorting field types by descending value.
     */
    case DESC = 'desc';
}
