<?php

namespace OpenBreweryDb\Responses\Breweries;

use OpenBreweryDb\Contracts\ResponseContract;
use OpenBreweryDb\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{
 *      id: string,
 *      name: string,
 *      brewery_type: string,
 *      address_1: string,
 *      address_2: ?string,
 *      address_3: ?string,
 *      city: string,
 *      state_province: string,
 *      postal_code: string,
 *      country: string,
 *      longitude: ?string,
 *      latitude: ?string,
 *      phone: string,
 *      website_url: string,
 *      state: string,
 *      street: string
 *  }>
 */
final readonly class FindResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{
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
     *        longitude: ?string,
     *        latitude: ?string,
     *        phone: string,
     *        website_url: ?string,
     *        state: string,
     *        street: string
     *  }>
     */
    use ArrayAccessible;

    private function __construct(
        public string  $id,
        public string  $name,
        public string  $brewery_type,
        public string  $address_1,
        public ?string $address_2,
        public ?string $address_3,
        public string  $city,
        public string  $state_province,
        public string  $postal_code,
        public string  $country,
        public ?string $longitude,
        public ?string $latitude,
        public string  $phone,
        public ?string $website_url,
        public string  $state,
        public string  $street,
    )
    {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array{
     *      id: string,
     *      name: string,
     *      brewery_type: string,
     *      address_1: string,
     *      address_2: ?string,
     *      address_3: ?string,
     *      city: string,
     *      state_province: string,
     *      postal_code: string,
     *      country: string,
     *      longitude: ?string,
     *      latitude: ?string,
     *      phone: string,
     *      website_url: ?string,
     *      state: string,
     *      street: string
     *  } $data
     */
    public static function from(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['brewery_type'],
            $data['address_1'],
            $data['address_2'],
            $data['address_3'],
            $data['city'],
            $data['state_province'],
            $data['postal_code'],
            $data['country'],
            $data['longitude'],
            $data['latitude'],
            $data['phone'],
            $data['website_url'],
            $data['state'],
            $data['street'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brewery_type' => $this->brewery_type,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'address_3' => $this->address_3,
            'city' => $this->city,
            'state_province' => $this->state_province,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'phone' => $this->phone,
            'website_url' => $this->website_url,
            'state' => $this->state,
            'street' => $this->street,
        ];
    }
}
