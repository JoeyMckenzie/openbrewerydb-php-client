<?php

declare(strict_types=1);

use OpenBrewery\OpenBrewery\OpenBreweryClient;

describe('Random breweries', function () {

    it('retrieves a list of random breweries', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $breweries = $client->breweries()->random();
        $brewery = $breweries[0];

        // Assert
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBe(1);
        expectBreweryToBeValid($brewery);
    });

    it('retrieves multiple random breweries when given a size', function () {
        // Arrange
        $client = new OpenBreweryClient();
        $numberOfBreweries = rand(2, 50);

        // Act
        $breweries = $client->breweries()->random($numberOfBreweries);

        // Assert
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBe($numberOfBreweries);
        expectAllBreweriesToBeValid($breweries);
    });
});
