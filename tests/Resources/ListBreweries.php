<?php

declare(strict_types=1);

namespace Tests\Resources;

use OpenBreweryDb\Client;
use OpenBreweryDb\OpenBreweryDb;

describe('Listing breweries', function () {
    it('returns a valid list of breweries with properties set to the default pagination limit', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->list();

        // Assert
        expect(count($breweries->toArray()))->toBe(Client::PER_PAGE);
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

    it('returns a valid list of breweries with properties set to the number of paginated results', function () {
        // Arrange
        $client = OpenBreweryDb::client();
        $pagedResults = rand(50, 200);

        // Act
        $breweries = $client->breweries()->list([
            'per_page' => $pagedResults,
        ]);

        // Assert
        expect(count($breweries->toArray()))->toBe($pagedResults);
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

    it('retrieves a list of breweries by name', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->list([
            'by_name' => 'Dog',
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
                ->and(strtolower($brewery['name']))->toContain('dog');
        }
    });

    it('retrieves a list of breweries by state', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->list([
            'by_state' => 'Oregon',
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
                ->and($brewery['state'])->toBe('Oregon');
        }
    });

    it('retrieves a list of breweries by multiple state names', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->list([
            'by_state' => 'New York',
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
                ->and($brewery['state'])->toBe('New York');
        }
    });

    it('retrieves a list of breweries by type', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->list([
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
                ->and($brewery['brewery_type'])->toBe('micro');
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
