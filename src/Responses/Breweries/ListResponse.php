<?php

declare(strict_types=1);

namespace OpenBreweryDb\Responses\Breweries;

use OpenBreweryDb\Contracts\ResponseContract;
use OpenBreweryDb\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array<int, array{
 *         id: string,
 *         name: string,
 *         brewery_type: ?string,
 *         address_1: ?string,
 *         address_2: ?string,
 *         address_3: ?string,
 *         city: string,
 *         state_province: string,
 *         postal_code: string,
 *         country: string,
 *         longitude: ?string,
 *         latitude: ?string,
 *         phone: ?string,
 *         website_url: ?string,
 *         state: string,
 *         street: ?string
 * }>>
 */
final readonly class ListResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array<int, array{
     *          id: string,
     *          name: string,
     *          brewery_type: ?string,
     *          address_1: ?string,
     *          address_2: ?string,
     *          address_3: ?string,
     *          city: string,
     *          state_province: string,
     *          postal_code: string,
     *          country: string,
     *          longitude: ?string,
     *          latitude: ?string,
     *          phone: ?string,
     *          website_url: ?string,
     *          state: string,
     *          street: ?string
     *      }>>
     */
    use ArrayAccessible;

    /**
     * @param FindResponse[] $data
     */
    private function __construct(public array $data)
    {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param array<int, array{
     *          id: string,
     *          name: string,
     *          brewery_type: ?string,
     *          address_1: ?string,
     *          address_2: ?string,
     *          address_3: ?string,
     *          city: string,
     *          state_province: string,
     *          postal_code: string,
     *          country: string,
     *          longitude: ?string,
     *          latitude: ?string,
     *          phone: ?string,
     *          website_url: ?string,
     *          state: string,
     *          street: ?string
     *    }> $attributes
     */
    public static function from(array $attributes): self
    {
        $mappedData = array_map(fn(array $result): FindResponse => FindResponse::from(
            $result,
        ), $attributes);

        return new self($mappedData);
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function toArray(): array
    {
        return array_map(
            static fn(FindResponse $response): array => $response->toArray(),
            $this->data,
        );
    }
}
