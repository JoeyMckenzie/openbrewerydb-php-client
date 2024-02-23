<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery;

use GuzzleHttp\Client;
use OpenBrewery\OpenBrewery\Breweries\BreweryClient;
use OpenBrewery\OpenBrewery\Contracts\ScopedApiConnector;
use Psr\Http\Client\ClientInterface;

/**
 * A top-level Open Brewery DB client encompassing child API connectors and an internal HTTP client.
 */
final class ConfigurableClient implements ScopedApiConnector
{

  public function __construct(ClientInterface $client)
  {
  }

  /**
   * Constructs a new brewery client API instance.
   */
  public function breweries(): BreweryClient
  {
  }
}
