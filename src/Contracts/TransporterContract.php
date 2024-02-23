<?php

namespace OpenAI\Contracts;

use BreweriesContract;

interface ClientContract
{
    public function breweries(): BreweriesContract;
}
