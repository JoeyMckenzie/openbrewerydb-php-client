<?php

declare(strict_types=1);

use OpenBrewery\OpenBrewery\BreweryType;
use OpenBrewery\OpenBrewery\OpenBreweryClient;

describe('Brewery Client', function () {
    it('retrieves a brewery when given an ID', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $brewery = $client->breweries()->find('b54b16e1-ac3b-4bff-a11f-f7ae9ddc27e0');

        // Assert
        expect($brewery)->not()->toBeNull()
            ->and($brewery?->id)->not()->toBeNull()
            ->and($brewery?->name)->not()->toBeNull()
            ->and($brewery?->addressOne)->not()->toBeNull()
            ->and($brewery?->city)->not()->toBeNull()
            ->and($brewery?->country)->not()->toBeNull()
            ->and($brewery?->latitude)->not()->toBeNull()
            ->and($brewery?->longitude)->not()->toBeNull()
            ->and($brewery?->phone)->not()->toBeNull()
            ->and($brewery?->postalCode)->not()->toBeNull()
            ->and($brewery?->state)->not()->toBeNull()
            ->and($brewery?->stateProvince)->not()->toBeNull()
            ->and($brewery?->street)->not()->toBeNull()
            ->and($brewery?->websiteUrl)->not()->toBeNull()
            ->and($brewery?->breweryType)->not()->toBeNull()
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

    it('retrieves a list of breweries', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $breweries = $client->breweries()->list();

        // Assert
        expect($breweries)->not()->toBeNull();
        expectAllBreweriesToBeValid($breweries);
    });

    it('retrieves a list of random breweries', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $breweries = $client->breweries()->random();
        $brewery = $breweries[0];

        // Assert
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBe(1)
            ->and($brewery)->toBeMinimallyValidBrewery();
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
