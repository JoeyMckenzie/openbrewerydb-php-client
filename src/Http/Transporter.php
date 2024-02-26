<?php

namespace OpenBreweryDb\Http;

use Closure;
use GuzzleHttp\Exception\ClientException;
use JsonException;
use OpenBreweryDb\Contracts\TransporterContract;
use OpenBreweryDb\Exceptions\ErrorException;
use OpenBreweryDb\Exceptions\TransporterException;
use OpenBreweryDb\Exceptions\UnserializableResponseException;
use OpenBreweryDb\Responses\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
final readonly class Transporter implements TransporterContract
{
    /**
     * Creates a new Http Transporter instance.
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
    public function requestObject(Payload $payload): Response
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);
        $response = $this->sendRequest(fn (): ResponseInterface => $this->client->sendRequest($request));
        $contents = $response->getBody()->getContents();

        $this->throwIfJsonError($response, $contents);

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $data */
            $data = json_decode($contents, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponseException($jsonException);
        }

        return Response::from($data);
    }

    /**
     * @throws TransporterException
     * @throws ErrorException
     * @throws UnserializableResponseException
     */
    private function sendRequest(Closure $callable): ResponseInterface
    {
        try {
            return $callable();
        } catch (ClientExceptionInterface $clientException) {
            if ($clientException instanceof ClientException) {
                $this->throwIfJsonError($clientException->getResponse(), $clientException->getResponse()->getBody()->getContents());
            }

            throw new TransporterException($clientException);
        }
    }

    /**
     * @throws ErrorException
     * @throws UnserializableResponseException
     */
    private function throwIfJsonError(ResponseInterface $response, string|ResponseInterface $contents): void
    {
        if ($response->getStatusCode() < 400) {
            return;
        }

        if (! str_contains($response->getHeaderLine('Content-Type'), ContentType::JSON->value)) {
            return;
        }

        if ($contents instanceof ResponseInterface) {
            $contents = $contents->getBody()->getContents();
        }

        try {
            /** @var array{error?: array{message: string|array<int, string>, type: string, code: string}} $response */
            $response = json_decode($contents, true, flags: JSON_THROW_ON_ERROR);

            if (isset($response['error'])) {
                throw new ErrorException($response['error']);
            }
        } catch (JsonException $jsonException) {
            throw new UnserializableResponseException($jsonException);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function requestContent(Payload $payload): string
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);
        $response = $this->sendRequest(fn (): ResponseInterface => $this->client->sendRequest($request));
        $contents = $response->getBody()->getContents();

        $this->throwIfJsonError($response, $contents);

        return $contents;
    }
}