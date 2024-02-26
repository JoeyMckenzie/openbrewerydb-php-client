<?php

declare(strict_types=1);

namespace OpenBreweryDb\Resources;

use OpenBreweryDb\Contracts\Resources\BreweriesContract;
use OpenBreweryDb\Contracts\TransporterContract;
use OpenBreweryDb\Exceptions\ErrorException;
use OpenBreweryDb\Exceptions\TransporterException;
use OpenBreweryDb\Exceptions\UnserializableResponseException;
use OpenBreweryDb\Responses\Breweries\FindResponse;
use OpenBreweryDb\Responses\Breweries\ListResponse;
use OpenBreweryDb\ValueObjects\Payload;
use OpenBreweryDb\ValueObjects\Transporter\Response;
use Override;

final readonly class Breweries implements BreweriesContract
{
    public function __construct(private TransporterContract $transporter)
    {
    }

    /**
     * @throws ErrorException
     * @throws TransporterException
     * @throws UnserializableResponseException
     */
    #[Override]
    public function find(string $id): FindResponse
    {
        $payload = Payload::retrieve('breweries', $id);

        /**
         * @var Response<array{
         *        id: string,
         *        name: string,
         *        brewery_type: string,
         *        address_1: string,
         *        address_2: ?string,
         *        address_3: ?string,
         *        city: string,
         *        state_province: string,
         *        postal_code: string,
         *        country: string,
         *        longitude: string,
         *        latitude: string,
         *        phone: string,
         *        website_url: ?string,
         *        state: string,
         *        street: string
         *  }> $response
         */
        $response = $this->transporter->requestData($payload);

        return FindResponse::from($response->data());
    }

    /**
     * Builds a list request payload for the breweries resource.
     *
     * @param array<string, string|int|float> $parameters
     *
     * @throws ErrorException
     * @throws TransporterException
     * @throws UnserializableResponseException
     */
    #[Override]
    public function list(array $parameters = []): ListResponse
    {
        $payload = Payload::list('breweries', $parameters);

        /**
         * @var Response<array<int, array{
         *            id: string,
         *            name: string,
         *            brewery_type: string,
         *            address_1: string,
         *            address_2: ?string,
         *            address_3: ?string,
         *            city: string,
         *            state_province: string,
         *            postal_code: string,
         *            country: string,
         *            longitude: string,
         *            latitude: string,
         *            phone: string,
         *            website_url: ?string,
         *            state: string,
         *            street: string
         *     }>> $response
         */
        $response = $this->transporter->requestData($payload);

        return ListResponse::from($response->data());
    }
}
