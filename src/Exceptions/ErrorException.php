<?php

declare(strict_types=1);

namespace OpenBreweryDb\Exceptions;

use Exception;

/**
 * Represents a generic exception occurring anywhere within the library.
 */
final class ErrorException extends Exception
{
    public function __construct(readonly string $errorMessage)
    {
        parent::__construct($errorMessage);
    }

    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }
}
