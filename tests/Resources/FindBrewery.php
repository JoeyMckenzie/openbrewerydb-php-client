<?php

namespace Tests\Resources;

use OpenBreweryDb\OpenBreweryDb;

describe('Finding breweries', function () {
    it('returns a valid brewery if it exists', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $brewery = $client->breweries()->find('b54b16e1-ac3b-4bff-a11f-f7ae9ddc27e0');

        // Assert
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

    it('returns an error if no brewery is found', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $brewery = $client->breweries()->find('b54b16e1-ac3b-4bff-a11f-f7ae9ddc27e0');

        // Assert
        expect($brewery)->toBeNull();
    });
});
