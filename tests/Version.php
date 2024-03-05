<?php

declare(strict_types=1);

namespace Tests;

use OpenBreweryDb\ValueObjects\Version;

test('Version should be correct', fn () => expect(Version::current())->toBe('0.8.0'));
