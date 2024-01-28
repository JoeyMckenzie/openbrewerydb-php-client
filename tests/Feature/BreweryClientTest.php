<?php

use GuzzleHttp\Exception\ConnectException;
use OpenBrewery\OpenBrewery\Breweries\BreweryType;
use OpenBrewery\OpenBrewery\OpenBreweryClientClient;

describe('Brewery client', function () {
    it('timeouts the request when provided when instantiating a new client', function () {
        // Arrange
        $client = new OpenBreweryClientClient(0.01);

        // Act
        $client->breweries()->list(type: BreweryType::MICRO);
    })->throws(ConnectException::class);
});
