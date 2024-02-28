<?php

declare(strict_types=1);

use OpenBreweryDb\OpenBreweryDb;

require_once __DIR__.'/../vendor/autoload.php';

/**
 * Using the client builder with PSR HTTP client autodiscovery,
 * we can use any PSR-17 compliant client library. This makes
 * it relatively simple to swap providers without having to
 * change the internal API connections and implementation. In
 * the following example, Guzzle's HTTP client is used, though
 * this could easily be swapped out for Symfony's client as well.
 */
$guzzleClient = new GuzzleHttp\Client([
    'timeout' => 5,
]);

$openBreweryDbClient = OpenBreweryDb::builder()
    ->withHttpClient($guzzleClient)
    ->withHeader('foo', 'bar')
    ->build();

// Get a list of breweries, based on all types of different search criteria
$breweries = $openBreweryDbClient->breweries()->list([
    'by_city' => 'Sacramento',
]);
var_dump($breweries);

// Retrieve various metadata about breweries from the API
$metadata = $openBreweryDbClient->breweries()->metadata();
var_dump($metadata);

// Get a random brewery with a specified page size
$randomBrewery = $openBreweryDbClient->breweries()->random(5);
var_dump($randomBrewery);
