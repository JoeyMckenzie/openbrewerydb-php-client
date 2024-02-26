<?php

namespace OpenBreweryDb\Exceptions;

use Exception;
use JsonException;

final class UnserializableResponseException extends Exception
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct(JsonException $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }
}
