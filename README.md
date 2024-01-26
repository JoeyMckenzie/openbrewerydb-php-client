# Open Brewery DB PHP API

[![CI](https://github.com/JoeyMckenzie/openbrewerydb-php-api/actions/workflows/ci.yml/badge.svg)](https://github.com/JoeyMckenzie/openbrewerydb-php-api/actions/workflows/ci.yml)

(Un)official PHP bindings for the [Open Brewery DB API](https://openbrewerydb.org/). Open Brewery DB provides a public
dataset for breweries around the world, as well as offering an API to retrieve data in various forms. This library
provides a straight and easy-to-use PHP bindings for querying the API

To get started, first install the package with composer:

```shell
$ composer require joeymckenzie/openbrewerydb-php-api
```

Next, instantiate the client from you code. Note, you should aim to only instantiate the client once as it uses Guzzle
under the hood:

```php
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
```

For the entire set of APIs offered by Open Brewery DB, check out the docs on
their [website](https://openbrewerydb.org/documentation).