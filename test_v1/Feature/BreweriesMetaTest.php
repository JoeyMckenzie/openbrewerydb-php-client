<?php

namespace OpenBrewery\Tests;

declare(strict_types=1);

use OpenBrewery\OpenBrewery\Breweries\BreweryType;
use OpenBrewery\OpenBrewery\ClientConnector;

describe('Breweries meta', function () {
    it('retrieves metadata for U.S. breweries by default', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $metadata = $client->breweries()->meta();

        // Assert
        expect($metadata)->not()->toBeNull()
            ->and(intval($metadata->total))->toBe(8237)
            ->and(intval($metadata->perPage))->toBe(50)
            ->and(intval($metadata->page))->toBe(1);
    });

    it('retrieves metadata for other countries', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $metadata = $client->breweries()->meta('South Korea');

        // Assert
        expect($metadata)->not()->toBeNull()
            ->and(intval($metadata->total))->toBe(61)
            ->and(intval($metadata->perPage))->toBe(50)
            ->and(intval($metadata->page))->toBe(1);
    });

    it('retrieves metadata for brewery types', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $metadata = $client->breweries()->meta(type: BreweryType::MICRO);

        // Assert
        expect($metadata)->not()->toBeNull()
            ->and(intval($metadata->total))->toBe(4266)
            ->and(intval($metadata->perPage))->toBe(50)
            ->and(intval($metadata->page))->toBe(1);
    });
});
