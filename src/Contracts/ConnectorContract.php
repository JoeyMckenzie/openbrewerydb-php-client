<?php

declare(strict_types=1);

namespace OpenBreweryDb\Contracts;

use OpenBreweryDb\Exceptions\ErrorException;
use OpenBreweryDb\Exceptions\TransporterException;
use OpenBreweryDb\Exceptions\UnserializableResponseException;
use OpenBreweryDb\ValueObjects\Payload;
use OpenBreweryDb\ValueObjects\Transporter\Response;

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
     * @throws ErrorException|UnserializableResponseException|TransporterException
     */
    public function requestData(Payload $payload): Response;
}
