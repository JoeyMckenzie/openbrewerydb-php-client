<?php

namespace OpenBrewery\OpenBrewery\Breweries;

enum SortBy: string
{
    case NAME = 'name';

    case TYPE = 'brewery_type';

    case ADDRESS_ONE = 'address_1';

    case ADDRESS_TWO = 'address_2';

    case ADDRESS_THREE = 'address_3';

    case CITY = 'city';
}
