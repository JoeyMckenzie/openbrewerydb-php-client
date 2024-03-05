<?php

declare(strict_types=1);

namespace Tests\Resources;

use OpenBreweryDb\OpenBreweryDb;

describe('Searching breweries', function () {
    it('returns a valid list of breweries with properties that meet the search criteria', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->search('dog', 3);

        // Assert
        foreach ($breweries->toArray() as $brewery) {
            expect($brewery)->not()->toBeNull()
                ->and($brewery['id'])->not()->toBeNull()
                ->and($brewery['brewery_type'])->not()->toBeNull()
                ->and($brewery['state'])->not()->toBeNull()
                ->and($brewery['state_province'])->not()->toBeNull()
                ->and($brewery['postal_code'])->not()->toBeNull()
                ->and($brewery['country'])->not()->toBeNull()
                ->and($brewery['city'])->not()->toBeNull()
                ->and($brewery['name'])->not()->toBeNull()
                ->and(strtolower($brewery['name']))->toContain('dog');
        }
    });

    it('returns no breweries if the search criteria is not met', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->search('not a brewery');

        // Assert
        expect($breweries->toArray())->toBeEmpty();
    });
});
