<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects\Connector;

use OpenBreweryDb\Contracts\Concerns\Arrayable;

/**
 * @implements Arrayable<array<string, string|int|float>>
 *
 * @internal
 */
final readonly class QueryParams implements Arrayable
{
    /**
     * Creates a new Query Params value object.
     *
     * @param  array<string, string|int|float>  $params
     */
    private function __construct(private array $params)
    {
    }

    /**
     * Creates a new Query Params value object
     */
    public static function create(): self
    {
        return new self([]);
    }

    /**
     * Creates a new Query Params value object, with the newly added param, and the existing params.
     */
    public function withParam(string $name, string|int $value): self
    {
        return new self([
            ...$this->params,
            $name => $value,
        ]);
    }

    #[\Override]
    public function toArray(): array
    {
        return $this->params;
    }
}
