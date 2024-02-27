<?php

declare(strict_types=1);

namespace Tests;

test('All source files are strictly typed')->expect('OpenBreweryDb\\')->toUseStrictTypes();

test('All tests files are strictly typed')->expect('Tests\\')->toUseStrictTypes();
