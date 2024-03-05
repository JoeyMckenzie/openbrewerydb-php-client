<?php

declare(strict_types=1);

namespace OpenBreweryDb\ValueObjects\Connector;

use Override;
use Stringable;

/**
 * A value object for representing the base URI on all requests.
 *
 * @internal
 */
final readonly class BaseUri implements Stringable
{
    /**
     * Creates a new Base URI value object.
     */
    private function __construct(private string $baseUri)
    {
    }

    #[Override]
    public function __toString(): string
    {
        foreach (['http://', 'https://'] as $protocol) {
            if (str_starts_with($this->baseUri, $protocol)) {
                return "$this->baseUri/";
            }
        }

        return "https://$this->baseUri/";
    }

    /**
     * Creates a new Base URI value object.
     */
    public static function from(string $baseUri): self
    {
        return new self($baseUri);
    }
}
