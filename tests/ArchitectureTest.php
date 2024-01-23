<?php

declare(strict_types=1);

test('all files should be strictly typed', fn () => expect('OpenBrewery\OpenBrewery')
    ->toUseStrictTypes()
    ->and('OpenBrewery\OpenBrewery')
    ->classes()
    ->toBeFinal());
