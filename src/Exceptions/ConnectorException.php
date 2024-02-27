<?php

declare(strict_types=1);

namespace OpenBreweryDb\Exceptions;

use Exception;
use Psr\Http\Client\ClientExceptionInterface;

final class ConnectorException extends Exception
{
    /**
     * Creates a new Exception instance.
     */
    public function __construct(ClientExceptionInterface $exception)
    {
        parent::__construct($exception->getMessage(), 0, $exception);
    }
}
