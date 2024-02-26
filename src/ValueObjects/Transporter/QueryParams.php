<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects\Transporter;

/**
 * @internal
 */
final readonly class QueryParams
{
    /**
     * Creates a new Query Params value object.
     *
     * @param array<string, string|int|float> $params
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

    /**
     * @return array<string, string|int|float>
     */
    public function toArray(): array
    {
        return $this->params;
    }
}
