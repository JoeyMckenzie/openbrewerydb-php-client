<?php

namespace Tests\Resources;

use OpenBreweryDb\Client;
use OpenBreweryDb\OpenBreweryDb;

describe('Random breweries', function () {
    it('returns one valid brewery with properties when no size given', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->random();
        $brewery = $breweries[0];

        // Assert
        expect(count($breweries->toArray()))->toBe(1);
        expect($brewery)->not()->toBeNull()
            ->and($brewery['id'])->not()->toBeNull()
            ->and($brewery['brewery_type'])->not()->toBeNull()
            ->and($brewery['state'])->not()->toBeNull()
            ->and($brewery['state_province'])->not()->toBeNull()
            ->and($brewery['postal_code'])->not()->toBeNull()
            ->and($brewery['country'])->not()->toBeNull()
            ->and($brewery['city'])->not()->toBeNull()
            ->and($brewery['name'])->not()->toBeNull();
    });

    it('returns specified number of random breweries', function () {
        // Arrange
        $client = OpenBreweryDb::client();
        $randomBreweries = rand(2, Client::PER_PAGE);

        // Act
        $breweries = $client->breweries()->random($randomBreweries);

        // Assert
        expect(count($breweries->toArray()))->toBe($randomBreweries);
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
});
