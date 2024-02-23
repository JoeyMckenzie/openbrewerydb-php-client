<?php

declare(strict_types=1);

namespace OpenBreweryDb\Resources;

use OpenBreweryDb\Contracts\Resources\BreweriesContract;
use OpenBreweryDb\Contracts\TransporterContract;
use OpenBreweryDb\Responses\Breweries\FindResponse;
use OpenBreweryDb\Responses\Breweries\ListResponse;
use Override;

final readonly class Breweries implements BreweriesContract
{
    public function __construct(private TransporterContract $transporter)
    {
    }

    #[Override]
    public function find(string $id): FindResponse
    {
        // TODO: Implement find() method.
    }

    #[Override]
    public function list(): ListResponse
    {
        // TODO: Implement list() method.
    }
}
