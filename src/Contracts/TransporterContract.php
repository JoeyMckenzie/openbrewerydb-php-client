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
interface TransporterContract
{
    /**
     * Sends a request to a server.
     *
     * @return Response<array<array-key, mixed>>
     *
     * @throws ErrorException|UnserializableResponseException|TransporterException
     */
    public function requestData(Payload $payload): Response;

    /**
     * Sends a content request to a server.
     *
     * @throws ErrorException|TransporterException
     */
    public function requestContent(Payload $payload): string;
}
