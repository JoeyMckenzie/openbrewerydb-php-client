<?php

declare(strict_types=1);

namespace OpenBreweryDb\Contracts\Resources;

use OpenBreweryDb\Responses\Breweries\FindResponse;
use OpenBreweryDb\Responses\Breweries\ListResponse;

interface BreweriesContract
{
    public function find(string $id): FindResponse;

    public function list(): ListResponse;
}
