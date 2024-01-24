<?php

declare(strict_types=1);

use OpenBrewery\OpenBrewery\Breweries\Brewery;
use OpenBrewery\OpenBrewery\Breweries\BreweryType;
use OpenBrewery\OpenBrewery\OpenBreweryClient;

describe('Brewery Client', function () {
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

    it('retrieves a list of breweries', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $breweries = $client->breweries()->list();

        // Assert
        expect($breweries)->not()->toBeNull();
        expectAllBreweriesToBeValid($breweries);
    });

    it('retrieves a list of breweries by name', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $breweries = $client->breweries()->list(name: 'dog');

        // Assert by name
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBeGreaterThan(1);
        expectAllBreweriesToBeValid($breweries);
        expect(collect($breweries)->every(fn (Brewery $brewery) => str_contains(strtolower($brewery->name), 'dog')))->toBeTrue();
    });

    it('retrieves a list of breweries by state', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $breweries = $client->breweries()->list(state: 'California');

        // Assert by name
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBeGreaterThan(1);
        expectAllBreweriesToBeValid($breweries);
        collect($breweries)->each(fn (Brewery $brewery) => expect($brewery->state)->toBe('California')
            ->and($brewery->stateProvince)->toBe('California'));
    });

    it('retrieves a list of breweries by multiple state names', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $breweries = $client->breweries()->list(state: 'New York');

        // Assert by name
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBeGreaterThan(1);
        expectAllBreweriesToBeValid($breweries);
        collect($breweries)->each(fn (Brewery $brewery) => expect($brewery->state)->toBe('New York')
            ->and($brewery->stateProvince)->toBe('New York'));
    });

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
