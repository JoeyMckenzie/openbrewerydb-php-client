<?php

declare(strict_types=1);

namespace OpenBreweryDb\Contracts;

use OpenBreweryDb\Exceptions\ConnectorException;
use OpenBreweryDb\Exceptions\ErrorException;
use OpenBreweryDb\Exceptions\UnserializableResponseException;
use OpenBreweryDb\ValueObjects\Connector\Response;
use OpenBreweryDb\ValueObjects\Payload;

/**
 * @internal
 */
interface ConnectorContract
{
    /**
     * Sends a request to the server.
     *
     * @return Response<array<array-key, mixed>>
     *
     * @throws ErrorException|UnserializableResponseException|ConnectorException
     */
    public function requestData(Payload $payload): Response;
}
