<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

use OpenBrewery\OpenBrewery\Breweries\Brewery;

expect()->extend('toBeMinimallyValidBrewery', function () {
    /** @var Brewery $brewery */
    $brewery = $this->value;

    return $this->not()->toBeNull()
        ->and($brewery->id)->not()->toBeNull()
        ->and($brewery->breweryType)->not()->toBeNull()
        ->and($brewery->state)->not()->toBeNull()
        ->and($brewery->stateProvince)->not()->toBeNull()
        ->and($brewery->postalCode)->not()->toBeNull()
        ->and($brewery->country)->not()->toBeNull()
        ->and($brewery->city)->not()->toBeNull()
        ->and($brewery->name)->not()->toBeNull();
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

/**
 * A test helper for asserting all breweries within a collection include all the expected/required properties.
 *
 * @param  Brewery[]  $breweries
 */
function expectAllBreweriesToBeValid(array $breweries): void
{
    collect($breweries)->each(fn (Brewery $brewery) => expect($brewery->id)->not()->toBeNull()
        ->and($brewery->breweryType)->not()->toBeNull()
        ->and($brewery->state)->not()->toBeNull()
        ->and($brewery->stateProvince)->not()->toBeNull()
        ->and($brewery->postalCode)->not()->toBeNull()
        ->and($brewery->country)->not()->toBeNull()
        ->and($brewery->city)->not()->toBeNull()
        ->and($brewery->name)->not()->toBeNull());
}

/**
 * A test helper for asserting a brewery contains the required properties.
 */
function expectBreweryToBeValid(?Brewery $brewery): void
{
    expect($brewery)->not()->toBeNull()
        ->and($brewery?->id)->not()->toBeNull()
        ->and($brewery?->breweryType)->not()->toBeNull()
        ->and($brewery?->state)->not()->toBeNull()
        ->and($brewery?->stateProvince)->not()->toBeNull()
        ->and($brewery?->postalCode)->not()->toBeNull()
        ->and($brewery?->country)->not()->toBeNull()
        ->and($brewery?->city)->not()->toBeNull()
        ->and($brewery?->name)->not()->toBeNull();
}
