<?php

declare(strict_types=1);

namespace OpenBreweryDb\Exceptions;

use Exception;
use Psr\Http\Client\ClientExceptionInterface;

/**
 * Represents an exception that occurs while sending request to Open Brewery DB.
 */
final class ConnectorException extends Exception
{
    public function __construct(ClientExceptionInterface $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }
}
