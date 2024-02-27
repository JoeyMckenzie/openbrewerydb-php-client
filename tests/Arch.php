<?php

declare(strict_types=1);

namespace Tests;

test('All source files are strictly typed')->expect('OpenBreweryDb\\')->toUseStrictTypes();

test('All tests files are strictly typed')->expect('Tests\\')->toUseStrictTypes();

test('Value objects should be immutable')
    ->expect('OpenBreweryDb\\ValueObjects\\')
    ->toBeFinal()
    ->and('OpenBreweryDb\\ValueObjects\\')
    ->toBeReadonly();

test('Contracts should be abstract')
    ->expect('OpenBreweryDb\\Contracts\\')
    ->toBeInterfaces();

test('All Enums are backed')
    ->expect('OpenBreweryDb\\Enums\\')
    ->toBeStringBackedEnums();
