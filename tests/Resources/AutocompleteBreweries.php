<?php

declare(strict_types=1);

namespace Tests\Resources;

use OpenBreweryDb\OpenBreweryDb;

describe('Autocomplete breweries', function () {
    it('returns a list of breweries with only IDs and names', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->autocomplete('dog');

        // Assert
        expect(count($breweries->toArray()))->toBe(15);
        foreach ($breweries->toArray() as $brewery) {
            expect($brewery)->not()->toBeNull()
                ->and($brewery['id'])->not()->toBeNull()
                ->and($brewery['name'])->not()->toBeNull()
                ->and(strtolower($brewery['name']))->toContain('dog');
        }
    });

    it('returns no breweries for autocomplete if the search criteria is not met', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->autocomplete('pneumonoultramicroscopicsilicovolcanoconiosis');

        // Assert
        expect($breweries->toArray())->toBeEmpty();
    });
});
