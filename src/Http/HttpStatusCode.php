<?php

namespace OpenBreweryDb\Http;

/**
 * @internal
 */
enum HttpStatusCode: int
{
    case OK = 200;

    case NOT_FOUND = 404;

    case INTERNAL_SERVER_ERROR = 500;
}
