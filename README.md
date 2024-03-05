![Logo](./assets/obdb.png)

<div align="center">
  <div style="display: inline-block;">
    <img src="https://github.com/JoeyMckenzie/openbrewerydb-php-api/actions/workflows/ci.yml/badge.svg" />
    <img src="https://github.styleci.io/repos/747020718/shield?style=flat"/>
  </div>
</div>

(Un)official PHP bindings for the [Open Brewery DB API](https://openbrewerydb.org/). Open Brewery DB provides a public
dataset for breweries around the world, as well as offering an API to retrieve data in various forms. This library aims to
provide straight and easy-to-use PHP bindings for querying the API. The library is inspired by the [Open AI client for PHP](https://github.com/openai-php/client) - please give it star as well!

 To get started, first install the package with composer:

```shell
$ composer require joeymckenzie/openbrewerydb-php-client
```

Next, spin up a new client within your code and fire away!

```php
<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use OpenBreweryDb\OpenBreweryDb;

$client = OpenBreweryDb::client();

// Get a list of breweries, based on all types of different search criteria
$breweries = $client->breweries()->list([
    'by_city' => 'Sacramento',
]);
var_dump($breweries);

// Retrieve various metadata about breweries from the API
$metadata = $client->breweries()->metadata();
var_dump($metadata);

// Get a random brewery with a specified page size
$randomBrewery = $client->breweries()->random(5);
var_dump($randomBrewery);
```

The library relies on autodiscovery and will use whichever package that implements PSR-17 within your composer
dependencies. You are free to use the HTTP client of you choice, though a popular package
is [Guzzle](https://docs.guzzlephp.org/en/stable/).

Though I am not affiliated with organization itself, check out the entire set of APIs offered by Open Brewery DB, check
out the docs on their [website](https://openbrewerydb.org/documentation).
