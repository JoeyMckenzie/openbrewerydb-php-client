<?php

namespace OpenBreweryDb\Http;

/**
 * @internal
 */
final readonly class BaseUri
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
