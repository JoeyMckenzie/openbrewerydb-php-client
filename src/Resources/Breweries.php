<?php

declare(strict_types=1);

namespace OpenBreweryDb\Resources;

use OpenBreweryDb\Contracts\Resources\BreweriesContract;
use OpenBreweryDb\Contracts\TransporterContract;
use OpenBreweryDb\Exceptions\ErrorException;
use OpenBreweryDb\Exceptions\TransporterException;
use OpenBreweryDb\Exceptions\UnserializableResponseException;
use OpenBreweryDb\Http\Payload;
use OpenBreweryDb\Responses\Breweries\FindResponse;
use OpenBreweryDb\Responses\Breweries\ListResponse;
use OpenBreweryDb\Responses\Response;
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
        $payload = Payload::retrieve('brewery', $id);

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
         *        website_url: string,
         *        state: string,
         *        street: string
         *  }> $response
         */
        $response = $this->transporter->requestObject($payload);

        return FindResponse::from($response->data());
    }

    /**
     * @throws TransporterException
     * @throws UnserializableResponseException
     * @throws ErrorException
     */
    #[Override]
    public function list(): ListResponse
    {
        $payload = Payload::list('breweries');

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
         *            website_url: string,
         *            state: string,
         *            street: string
         *     }>> $response
         */
        $response = $this->transporter->requestObject($payload);

        return ListResponse::from($response->data());
    }
}
