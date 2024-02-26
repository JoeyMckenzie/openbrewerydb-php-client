<?php

namespace Tests\Resources;

use OpenBreweryDb\OpenBreweryDb;

describe('Breweries list resource', function () {
    it('should return a valid list of breweries', function () {
        // Arrange
        $client = OpenBreweryDb::client();

        // Act
        $breweries = $client->breweries()->list();

        // Assert
    });
});