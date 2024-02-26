<?php

namespace Tests\Resources;

use OpenBreweryDb\OpenBreweryDb;

describe('Listing breweries', function () {
    it('returns a valid list of breweries with properties', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->list();

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
                ->and($brewery['name'])->not()->toBeNull();
        }
    });

    it('returns a valid list of breweries', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->list([
            'by_name' => 'dog',
            'by_state' => 'California',
            'by_type' => 'micro',
        ]);

        // Assert
        expect($breweries->toArray())->toBeGreaterThan(1);
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
                ->and(strtolower($brewery['name']))->toContain('dog')
                ->and($brewery['state'])->toContain('California');
        }
    });
});
