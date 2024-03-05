<?php

declare(strict_types=1);

namespace OpenBreweryDb\Enums;

/**
 * Represents various media types to be used in headers for expected/received responses.
 *
 * @internal
 */
enum MediaType: string
{
    case JSON = 'application/json';
}
