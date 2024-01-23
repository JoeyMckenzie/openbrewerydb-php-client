<?php

declare(strict_types=1);

use OpenBrewery\OpenBrewery\Brewery;
use OpenBrewery\OpenBrewery\BreweryType;
use OpenBrewery\OpenBrewery\OpenBreweryClient;

describe('Brewery Client', function () {
    it('retrieves a brewery when given an ID', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $response = $client->breweries()->find('b54b16e1-ac3b-4bff-a11f-f7ae9ddc27e0');

        // Assert
        expect($response)->not()->toBeNull()
            ->and($response?->id)->not()->toBeNull()
            ->and($response?->name)->not()->toBeNull()
            ->and($response?->addressOne)->not()->toBeNull()
            ->and($response?->city)->not()->toBeNull()
            ->and($response?->country)->not()->toBeNull()
            ->and($response?->latitude)->not()->toBeNull()
            ->and($response?->longitude)->not()->toBeNull()
            ->and($response?->phone)->not()->toBeNull()
            ->and($response?->postalCode)->not()->toBeNull()
            ->and($response?->state)->not()->toBeNull()
            ->and($response?->stateProvince)->not()->toBeNull()
            ->and($response?->street)->not()->toBeNull()
            ->and($response?->websiteUrl)->not()->toBeNull()
            ->and($response?->breweryType)->not()->toBeNull()
            ->and($response?->breweryType)->toBe(BreweryType::REGIONAL);
    });

    it('retrieves a list of breweries', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $response = $client->breweries()->list();

        // Assert
        expect($response)->not()->toBeNull();
        collect($response)->each(fn (Brewery $brewery) => expect($brewery->id)->not()->toBeNull()
            ->and($brewery->breweryType)->not()->toBeNull()
            ->and($brewery->state)->not()->toBeNull()
            ->and($brewery->stateProvince)->not()->toBeNull()
            ->and($brewery->postalCode)->not()->toBeNull()
            ->and($brewery->country)->not()->toBeNull()
            ->and($brewery->city)->not()->toBeNull()
            ->and($brewery->name)->not()->toBeNull());
    });

    it('retrieves a list of random breweries', function () {
        // Arrange
        $client = new OpenBreweryClient();

        // Act
        $response = $client->breweries()->random();
        $brewery = $response[0];

        // Assert
        expect($response)->not()->toBeNull()
            ->and(count($response))->toBe(1)
            ->and($brewery->id)->not()->toBeNull()
            ->and($brewery->breweryType)->not()->toBeNull()
            ->and($brewery->state)->not()->toBeNull()
            ->and($brewery->stateProvince)->not()->toBeNull()
            ->and($brewery->postalCode)->not()->toBeNull()
            ->and($brewery->country)->not()->toBeNull()
            ->and($brewery->city)->not()->toBeNull()
            ->and($brewery->name)->not()->toBeNull();
    });

    it('retrieves multiple random breweries when given a size', function () {
        // Arrange
        $client = new OpenBreweryClient();
        $numberOfBreweries = rand(2, 50);

        // Act
        $response = $client->breweries()->random($numberOfBreweries);

        // Assert
        expect($response)->not()->toBeNull()
            ->and(count($response))->toBe($numberOfBreweries);
        collect($response)->each(fn (Brewery $brewery) => expect($brewery->id)->not()->toBeNull()
            ->and($brewery->breweryType)->not()->toBeNull()
            ->and($brewery->state)->not()->toBeNull()
            ->and($brewery->stateProvince)->not()->toBeNull()
            ->and($brewery->postalCode)->not()->toBeNull()
            ->and($brewery->country)->not()->toBeNull()
            ->and($brewery->city)->not()->toBeNull()
            ->and($brewery->name)->not()->toBeNull());
    });
});
