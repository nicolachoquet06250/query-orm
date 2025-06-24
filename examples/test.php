<?php

use examples\itop\models\FacilitiesMonitoring;
use examples\itop\models\FunctionalCI;
use examples\salesforce\models\Account;
use QueryOrm\{
    Like, OrmFactory,
    OrmOperator as Op,
    StatusEnum as Status
};

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$fc = FacilitiesMonitoring::class;
$ci = FunctionalCI::class;

try {
    $itopFactory = OrmFactory::getItop();
    $sfFactory = OrmFactory::getSalesforce();

    echo "ITOP (OQL) => \n";
    $itopFactory
        ->select(
            "id", "name",
            "org_id", "organization_euclyde_id",
            "functionalci_id", "monitoring_id",
            "functionalci_id_finalclass_recall", "category",
            "etiquettes", "monitoring_box_name",
            "monitoring_host_standard_account", "monitoring_host_snmp",
            "monitoring_collecte_elect", "modele_name",
            "controle_name", "seuil_control_alerte",
            "seuil_control_critique"
        )
        ->from($fc)->join($ci, "functionalci_id = {$ci}::id")
        ->where("{$ci}::obsolescence_flag", Op::EQUALS, '0')
        ->andWhere('status', Op::EQUALS, Status::ACTIVE)
        ->orWhere("{$fc}::id", Op::IN)->notIn(OrmFactory::getItop()->select('id')->from($fc)->where('id', Op::EQUALS, 23)->getQl())
        ->build()->execute()->toArray();

    echo "\n";

    echo "SALESFORCE (SOQL) => \n";
    $sfFactory
        ->select(
            'id', 'IsDeleted', 'MasterRecordId', 'name',
            'Type', 'ParentId', 'BillingStreet', 'BillingCity',
            'BillingState', 'BillingPostalCode', 'BillingCountry', 'BillingLatitude',
            'BillingLongitude', 'BillingGeocodeAccuracy', 'BillingAddress', 'ShippingStreet',
            'ShippingCity', 'ShippingState', 'ShippingPostalCode', 'ShippingCountry',
            'ShippingLatitude', 'ShippingLongitude', 'ShippingGeocodeAccuracy', 'ShippingAddress',
            'Phone', 'Fax', 'AccountNumber', 'Website',
            'PhotoUrl', 'sic', 'Industry', 'AnnualRevenue',
            'NumberOfEmployees', 'Ownership', 'TickerSymbol', 'Description',
            'rating', 'site', 'CurrencyIsoCode', 'OwnerId',
            'CreatedDate', 'CreatedById', 'LastModifiedDate', 'LastModifiedById',
            'SystemModstamp', 'LastActivityDate', 'LastViewedDate', 'LastReferencedDate',
            'IsPartner', 'ChannelProgramName', 'ChannelProgramLevelName', 'jigsaw',
            'JigsawCompanyId', 'AccountSource', 'SicDesc', 'Customer_Number_Text__c'
        )
        ->from(Account::class)
        ->where('Id', Op::EQUALS, 23)
        ->andWhere('Name', Op::EQUALS, 'test')
        ->orWhere('Email')->notLike(Like::endsWith('@gmail.fr'))
        ->build()->execute()->toArray();

    echo "\n";

//OrmFactory::getCustom(CustomClass::class)
//	->select('id')
//	->from(CustomModel::class)
//	->where('id', Op::EQUALS, 23)
//	->andWhere('name', Op::EQUALS, 'test')
//	->andWhere('email')->notLike(Like::endsWith('@gmail.fr'));
} catch (Exception $e) {
    var_dump($e);
}