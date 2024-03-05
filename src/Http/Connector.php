<?php

declare(strict_types=1);

namespace OpenBreweryDb\Http;

use Closure;
use GuzzleHttp\Exception\ClientException;
use JsonException;
use OpenBreweryDb\Contracts\ConnectorContract;
use OpenBreweryDb\Enums\MediaType;
use OpenBreweryDb\Exceptions\ConnectorException;
use OpenBreweryDb\Exceptions\ErrorException;
use OpenBreweryDb\Exceptions\UnserializableResponseException;
use OpenBreweryDb\ValueObjects\Connector\BaseUri;
use OpenBreweryDb\ValueObjects\Connector\Headers;
use OpenBreweryDb\ValueObjects\Connector\QueryParams;
use OpenBreweryDb\ValueObjects\Connector\Response;
use OpenBreweryDb\ValueObjects\Payload;
use Override;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * An HTTP client connector orchestrating requests and responses to and from Open Brewery DB.
 *
 * @internal
 */
final readonly class Connector implements ConnectorContract
{
    /**
     * Creates a new Http connector instance.
     */
    public function __construct(
        private ClientInterface $client,
        private BaseUri $baseUri,
        private Headers $headers,
        private QueryParams $queryParams,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @throws ErrorException
     */
    #[Override]
    public function requestData(Payload $payload): Response
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);
        $response = $this->sendRequest(fn (): ResponseInterface => $this->client->sendRequest($request));
        $contents = $response->getBody()->getContents();

        $this->throwIfJsonError($response, $contents);

        try {
            $data = json_decode($contents, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponseException($jsonException);
        }

        // @phpstan-ignore-next-line: we'll assume the $data in the response model is a valid model
        return Response::from($data);
    }

    /**
     * Sends the composed request to the server.
     *
     * @throws ConnectorException|ErrorException|UnserializableResponseException
     */
    private function sendRequest(Closure $callable): ResponseInterface
    {
        try {
            return $callable();
        } catch (ClientExceptionInterface $clientException) {
            if ($clientException instanceof ClientException) {
                $this->throwIfJsonError($clientException->getResponse(), $clientException->getResponse()->getBody()->getContents());
            }

            throw new ConnectorException($clientException);
        }
    }

    /**
     * Analyzes the current error response to determine if the server sent us something we cannot deserialize.
     *
     * @throws ErrorException|UnserializableResponseException
     */
    private function throwIfJsonError(ResponseInterface $response, string|ResponseInterface $contents): void
    {
        // If we received a successful status despite sending the request throwing an exception,
        // bypass the checking for unserializable responses and propagate an connector exception
        if ($response->getStatusCode() < 400) {
            return;
        }

        // In the case the content type returned from the service is not JSON, bypass checking
        if (! str_contains($response->getHeaderLine('Content-Type'), MediaType::JSON->value)) {
            return;
        }

        if ($contents instanceof ResponseInterface) {
            $contents = $contents->getBody()->getContents();
        }

        try {
            /** @var array{message: ?string} $response */
            $response = json_decode($contents, true, flags: JSON_THROW_ON_ERROR);

            // Open Brewery DB will send back a "message" property in the JSON, so we'll
            // throw whatever is returned in those cases that it's detected on the response
            if (isset($response['message'])) {
                throw new ErrorException($response['message']);
            }
        } catch (JsonException $jsonException) {
            throw new UnserializableResponseException($jsonException);
        }
    }
}
