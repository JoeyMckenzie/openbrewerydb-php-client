<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use OpenBrewery\OpenBrewery\Breweries\BreweryType;
use OpenBrewery\OpenBrewery\OpenBreweryClient;

$client = new OpenBreweryClient();

// Get a list of breweries, based on all types of different search criteria
$breweries = $client->breweries()->list(type: BreweryType::BREWPUB);
var_dump($breweries);

// Retrieve various metadata about breweries from the API
$metadata = $client->breweries()->meta();
var_dump($metadata);

// Get a random brewery with a specified page size
$randomBrewery = $client->breweries()->random(5);
var_dump($randomBrewery);
