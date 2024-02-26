<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects\Transporter;

/**
 * @internal
 */
final readonly class BaseUri implements \Stringable
{
    /**
     * Creates a new Base URI value object.
     */
    private function __construct(private string $baseUri)
    {
    }

    /**
     * Creates a new Base URI value object.
     */
    public static function from(string $baseUri): self
    {
        return new self($baseUri);
    }

    #[\Override]
    public function __toString(): string
    {
        foreach (['http://', 'https://'] as $protocol) {
            if (str_starts_with($this->baseUri, $protocol)) {
                return "$this->baseUri/";
            }
        }

        return "https://$this->baseUri/";
    }
}
