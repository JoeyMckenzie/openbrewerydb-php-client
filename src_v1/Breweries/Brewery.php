<?php

declare(strict_types=1);

namespace OpenBrewery\OpenBrewery\Breweries;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Represents the various location, type, and metadata associated to a brewery returned by Open Brewery DB.
 */
final class Brewery extends AutocompleteBrewery
{
    /**
     * @var BreweryType|null Type of brewery, constrained.
     */
    public ?BreweryType $breweryType;

    /**
     * @var string|null Address of the brewery, optional.
     */
    #[SerializedName('address_1')]
    public ?string $addressOne;

    /**
     * @var string|null Additional address field, optional.
     */
    #[SerializedName('address_2')]
    public ?string $addressTwo;

    /**
     * @var string|null Additional address field, optional.
     */
    #[SerializedName('address_3')]
    public ?string $addressThree;

    /**
     * @var string City the brewery is located in.
     */
    public string $city;

    /**
     * @var string State province of the brewery.
     */
    public string $stateProvince;

    /**
     * @var string Postal code/zip code of the brewery.
     */
    public string $postalCode;

    /**
     * @var string Country of the brewery.
     */
    public string $country;

    /**
     * @var string|null Longitude of the brewery, optional.
     */
    public ?string $longitude;

    /**
     * @var string|null Latitude of the brewery, optional.
     */
    public ?string $latitude;

    /**
     * @var string|null Domestic phone number of the brewery, optional.
     */
    public ?string $phone;

    /**
     * @var string|null Website URL of the brewery, optional.
     */
    public ?string $websiteUrl;

    /**
     * @var string State of the brewery.
     */
    public string $state;

    /**
     * @var string|null Street address of the brewery, optional.
     */
    public ?string $street;
}
