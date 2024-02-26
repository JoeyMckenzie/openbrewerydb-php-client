<?php

namespace OpenBreweryDb\Http;

/**
 * @internal
 */
enum MediaType: string
{
    case JSON = 'application/json';

    case MULTIPART = 'multipart/form-data';

    case TEXT_PLAIN = 'text/plain';
}
