<?php

declare(strict_types=1);

namespace OpenBreweryDb\Exceptions;

use Exception;
use JsonException;

/**
 * Represents an exception corresponding to scenarios where Open Brewery DB returns an unexpected response that cannot be JSON deserialized.
 */
final class UnserializableResponseException extends Exception
{
    public function __construct(JsonException $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }
}
