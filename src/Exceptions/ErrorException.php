<?php

declare(strict_types=1);

namespace OpenBreweryDb\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct(readonly string $errorMessage)
    {
        parent::__construct($errorMessage);
    }

    /**
     * Returns the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }
}
