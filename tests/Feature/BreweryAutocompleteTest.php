<?php

declare(strict_types=1);

use OpenBrewery\OpenBrewery\Breweries\AutocompleteBrewery;
use OpenBrewery\OpenBrewery\ClientConnector;

describe('Autocomplete breweries', function () {
    it('retrieves a list of breweries including the search term', function () {
        // Arrange
        $client = new ClientConnector();

        // Act
        $breweries = $client->breweries()->autocomplete('barrel');

        // Assert
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBe(15);
        collect($breweries)->each(fn (AutocompleteBrewery $brewery) => expect(str_contains($brewery->name, 'barrel'))
            ->and($brewery->id)->not()->toBeNull());
    });

    it('retrieves no breweries when a match isn\'t found', function () {
        // Arrange
        $client = new ClientConnector();

        // Act... yes, it's a real word
        $breweries = $client->breweries()->autocomplete('pneumonoultramicroscopicsilicovolcanoconiosis');

        // Assert
        expect($breweries)->not()->toBeNull()
            ->and(count($breweries))->toBe(0);
    });
});
