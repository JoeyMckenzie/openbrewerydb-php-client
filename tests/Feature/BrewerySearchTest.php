<?php

declare(strict_types=1);

use OpenBrewery\OpenBrewery\Breweries\Brewery;
use OpenBrewery\OpenBrewery\ClientConnector;

describe('Searching breweries', function () {
    it('retrieves a list of breweries including the search term', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $breweries = $client->breweries()->search('barrel');

        // Assert
        expect($breweries)->not()->toBeNull();
        expectAllBreweriesToBeValid($breweries);
        collect($breweries)->each(fn (Brewery $brewery) => expect(str_contains($brewery->name, 'barrel')));
    });

    it('retrieves a list of breweries including the search term with a specified number of page results', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $breweries = $client->breweries()->search('barrel', 10);

        // Assert
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBe(10);
        expectAllBreweriesToBeValid($breweries);
        collect($breweries)->each(fn (Brewery $brewery) => expect(str_contains($brewery->name, 'barrel')));
    });

    it('retrieves no breweries when a match isn\'t found', function () {
        // Arrange
        $client = new ClientConnector();

        // Act... yes, it's a real word
        $breweries = $client->breweries()->search('pneumonoultramicroscopicsilicovolcanoconiosis');

        // Assert
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBe(0);
    });
});
