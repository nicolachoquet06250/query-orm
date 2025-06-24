<?php

namespace examples\salesforce\models;

use QueryOrm\Accessors;
use QueryOrm\salesforce\SalesforceModel;

class Account extends SalesforceModel
{
    public string $table {
        get => 'Account';
    }

    private ?string $id = null;
    private bool $isDeleted = false;
    private ?string $masterRecordId = null;
    private ?string $name = null;
    private ?string $type = null;
    private ?string $parentId = null;
    private ?string $billingStreet = null;
    private ?string $billingCity = null;
    private ?string $billingState = null;
    private ?string $billingPostalCode = null;
    private ?string $billingCountry = null;
    private ?float $billingLatitude = null;
    private ?float $billingLongitude = null;
    private ?string $billingGeocodeAccuracy = null;
    private string|array|Address|null $billingAddress = null;
    private ?string $shippingStreet = null;
    private ?string $shippingCity = null;
    private ?string $shippingState = null;
    private ?string $shippingPostalCode = null;
    private ?string $shippingCountry = null;
    private ?float $shippingLatitude = null;
    private ?float $shippingLongitude = null;
    private ?string $shippingGeocodeAccuracy = null;
    private ?Address $shippingAddress = null;
    private ?string $phone = null;
    private ?string $fax = null;
    private ?string $accountNumber = null;
    private ?string $website = null;
    private ?string $photoUrl = null;
    private ?string $sic = null;
    private ?string $industry = null;
    private ?string $annualRevenue = null;
    private ?int $numberOfEmployees = null;
    private ?string $ownership = null;
    private ?string $tickerSymbol = null;
    private ?string $description = null;
    private ?string $rating = null;
    private ?string $site = null;
    private ?string $currencyIsoCode = null;
    private ?string $ownerId = null;
    private ?string $createdDate = null;
    private ?string $createdById = null;
    private ?string $lastModifiedDate = null;
    private ?string $lastModifiedById = null;
    private ?string $systemModstamp = null;
    private ?string $lastActivityDate = null;
    private ?string $lastViewedDate = null;
    private ?string $lastReferencedDate = null;
    private bool $isPartner = false;
    private ?string $channelProgramName = null;
    private ?string $channelProgramLevelName = null;
    private ?string $jigsaw = null;
    private ?string $jigsawCompanyId = null;
    private ?string $accountSource = null;
    private ?string $sicDesc = null;

    #[Accessors(
        getter: 'getCustomerNumberTextC',
        setter: 'setCustomerNumberTextC'
    )]
    private ?string $customer_Number_Text__c = null;
}