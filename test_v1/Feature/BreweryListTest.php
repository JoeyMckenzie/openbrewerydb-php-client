<?php

namespace OpenBrewery\Tests;

declare(strict_types=1);

use OpenBrewery\OpenBrewery\Breweries\Brewery;
use OpenBrewery\OpenBrewery\Breweries\BreweryType;
use OpenBrewery\OpenBrewery\ClientConnector;

describe('Listing breweries', function () {
    it('retrieves a list of breweries', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $breweries = $client->breweries()->list();

        // Assert
        expect($breweries)->not()->toBeNull();
        expectAllBreweriesToBeValid($breweries);
    });

    it('retrieves a list of breweries by name', function () {
        // Arrange
        $client = new ClientConnector();

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
        $client = new ClientConnector();

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
        $client = new ClientConnector();

        // Act
        $breweries = $client->breweries()->list(state: 'New York');

        // Assert by name
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBeGreaterThan(1);
        expectAllBreweriesToBeValid($breweries);
        collect($breweries)->each(fn (Brewery $brewery) => expect($brewery->state)->toBe('New York')
            ->and($brewery->stateProvince)->toBe('New York'));
    });

    it('retrieves a list of breweries by type', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $breweries = $client->breweries()->list(type: BreweryType::MICRO);

        // Assert by name
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBeGreaterThan(1);
        expectAllBreweriesToBeValid($breweries);
        collect($breweries)->each(fn (Brewery $brewery) => expect($brewery->breweryType)->toBe(BreweryType::MICRO));
    });

    it('retrieves a list of breweries by multiple search criteria', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $breweries = $client->breweries()->list(
            name: 'dog',
            state: 'California',
            type: BreweryType::MICRO
        );

        // Assert by name
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBeGreaterThan(1);
        expectAllBreweriesToBeValid($breweries);
        collect($breweries)->each(fn (Brewery $brewery) => expect($brewery->breweryType)->toBe(BreweryType::MICRO)
            ->and(strtolower($brewery->name))->toContain('dog')
            ->and($brewery->state)->toBe('California'));
    });
});
