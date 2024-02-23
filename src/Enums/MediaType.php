<?php

namespace OpenBreweryDb\Enums;

/**
 * @internal
 */
enum MediaType: string
{
    case JSON = 'application/json';

    case MULTIPART = 'multipart/form-data';

    case TEXT_PLAIN = 'text/plain';
}