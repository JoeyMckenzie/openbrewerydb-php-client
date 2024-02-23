<?php

declare(strict_types=1);

namespace Tests;

test('all files should be strictly typed', fn() => expect('OpenBrewery')
    ->toUseStrictTypes()
    ->and('OpenBrewery\OpenBrewery')
    ->classes()
    ->toBeFinal());
