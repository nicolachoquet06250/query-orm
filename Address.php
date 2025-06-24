<?php


use QueryOrm\salesforce\SalesforceModel;

/**
 * @method static self convert(array $input)
 */
class Address extends SalesforceModel
{
    public string $table {
        get => 'Address';
    }

    private ?string $city = '';
    private ?string $country = '';
    private ?string $geocodeAccuracy = null;
    private ?float $latitude = null;
    private ?float $longitude = null;
    private ?string $postalCode = '';
    private ?string $state = null;
    private ?string $street = '';
}