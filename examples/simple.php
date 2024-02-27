<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use OpenBreweryDb\OpenBreweryDb;

$client = OpenBreweryDb::client();

// Get a list of breweries, based on all types of different search criteria
$breweries = $client->breweries()->list([
    'by_city' => 'Sacramento'
]);
var_dump($breweries);

// Retrieve various metadata about breweries from the API
$metadata = $client->breweries()->metadata();
var_dump($metadata);

// Get a random brewery with a specified page size
$randomBrewery = $client->breweries()->random(5);
var_dump($randomBrewery);
