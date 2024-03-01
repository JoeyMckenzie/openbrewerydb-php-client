<?php

declare(strict_types=1);

namespace OpenBreweryDb\Responses\Breweries;

use OpenBreweryDb\Contracts\ResponseContract;
use OpenBreweryDb\Responses\Concerns\ArrayAccessible;
use Override;

/**
 * Find responses represent data returned for breweries based on the provided UUID for the brewery.
 *
 * @see https://openbrewerydb.org/documentation#single-brewery
 *
 * @implements ResponseContract<array{id: string, name: string, brewery_type: ?string, address_1: ?string, address_2: ?string, address_3: ?string, city: string, state_province: string, postal_code: string, country: string, longitude: ?string, latitude: ?string, phone: ?string, website_url: ?string, state: string, street: ?string}>
 */
final readonly class FindResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, name: string, brewery_type: ?string, address_1: ?string, address_2: ?string, address_3: ?string, city: string, state_province: string, postal_code: string, country: string, longitude: ?string, latitude: ?string, phone: ?string, website_url: ?string, state: string, street: ?string}>
     */
    use ArrayAccessible;

    private function __construct(
        public string  $id,
        public string  $name,
        public ?string $brewery_type,
        public ?string $address_1,
        public ?string $address_2,
        public ?string $address_3,
        public string  $city,
        public string  $state_province,
        public string  $postal_code,
        public string  $country,
        public ?string $longitude,
        public ?string $latitude,
        public ?string $phone,
        public ?string $website_url,
        public string  $state,
        public ?string $street,
    )
    {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array{id: string, name: string, brewery_type: ?string, address_1: ?string, address_2: ?string, address_3: ?string, city: string, state_province: string, postal_code: string, country: string, longitude: ?string, latitude: ?string, phone: ?string, website_url: ?string, state: string, street: ?string} $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['name'],
            $attributes['brewery_type'],
            $attributes['address_1'],
            $attributes['address_2'],
            $attributes['address_3'],
            $attributes['city'],
            $attributes['state_province'],
            $attributes['postal_code'],
            $attributes['country'],
            $attributes['longitude'],
            $attributes['latitude'],
            $attributes['phone'],
            $attributes['website_url'],
            $attributes['state'],
            $attributes['street'],
        );
    }

    /**
     * {@inheritDoc}
     */
    #[Override]
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
