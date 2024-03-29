<?php

declare(strict_types=1);

namespace OpenBreweryDb\Responses\Breweries;

use OpenBreweryDb\Contracts\ResponseContract;
use OpenBreweryDb\Responses\Concerns\ArrayAccessible;
use Override;

/**
 * Autocomplete responses represent paginated data returned from the autocomplete endpoint, containing only top level
 * information about breweries provided by the query. Useful for  form field look aheads, fuzzy searching, etc.
 *
 * @see https://openbrewerydb.org/documentation#autocomplete
 *
 * @implements ResponseContract<array<int, array{id: string, name: string}>>
 */
final readonly class AutocompleteResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array<int, array{id: string, name: string}>>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, array{id: string, name: string}>  $data
     */
    private function __construct(public array $data)
    {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array<int, array{id: string, name: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes);
    }

    /**
     * {@inheritDoc}
     */
    #[Override]
    public function toArray(): array
    {
        return $this->data;
    }
}
