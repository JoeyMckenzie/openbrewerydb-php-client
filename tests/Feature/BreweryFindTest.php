<?php

declare(strict_types=1);

use OpenBrewery\OpenBrewery\Breweries\BreweryType;
use OpenBrewery\OpenBrewery\OpenBreweryClient;

describe('Brewery ScopedDataConnector', function () {
    it('retrieves a brewery when given an ID', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $brewery = $client->breweries()->find('b54b16e1-ac3b-4bff-a11f-f7ae9ddc27e0');

        // Assert
        expectBreweryToBeValid($brewery);
        expect($brewery)->not()->toBeNull()
            ->and($brewery?->addressOne)->not()->toBeNull()
            ->and($brewery?->latitude)->not()->toBeNull()
            ->and($brewery?->longitude)->not()->toBeNull()
            ->and($brewery?->phone)->not()->toBeNull()
            ->and($brewery?->street)->not()->toBeNull()
            ->and($brewery?->websiteUrl)->not()->toBeNull()
            ->and($brewery?->breweryType)->toBe(BreweryType::REGIONAL);
    });

    it('retrieves no breweries for an invalid ID', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $brewery = $client->breweries()->find('not-a-brewery');

        // Assert
        expect($brewery)->toBeNull();
    });
});
