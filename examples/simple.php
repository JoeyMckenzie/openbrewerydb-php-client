<?php

declare(strict_types=1);

require_once __DIR__.'/../src/OpenBreweryClient.php';

use OpenBrewery\OpenBrewery\Breweries\BreweryType;
use OpenBrewery\OpenBrewery\OpenBreweryClient;

$client = new OpenBreweryClient();
$breweries = $client->breweries()->list(type: BreweryType::BREWPUB);

var_dump($breweries);
