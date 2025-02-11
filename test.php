<?php

use QueryOrm\{Like, OrmFactory, OrmOperator, StatusEnum};

require_once 'vendor/autoload.php';

$customModel1 = ItopCustomModel::class;
$customModel2 = ItopCustomModel2::class;
//OrmFactory::getItop()
//	->select('id')
//	->from(ItopCustomModel::class)
//    ->join(ItopCustomModel2::class, "{$customModel1}::id = {$customModel2}::table1_id")
//    ->where('id', OrmOperator::SUP, 12)
//    ->andWhere(ItopCustomModel2::class.'::table1_id')->like(Like::customPattern('test%'))
//    ->orWhere(ItopCustomModel2::class.'::table1_id')->notLike(Like::customPattern('test%'))
//    ->execute();

$itopFactory = OrmFactory::getItop();
$itopFactory
    ->select(
        "id","name",
        "org_id","organization_euclyde_id",
        "functionalci_id","monitoring_id",
        "functionalci_id_finalclass_recall","category",
        "etiquettes","monitoring_box_name",
        "monitoring_host_standard_account","monitoring_host_snmp",
        "monitoring_collecte_elect","modele_name",
        "controle_name","seuil_control_alerte",
        "seuil_control_critique"
    )
    ->from(FacilitiesMonitoring::class)
    ->join(FunctionalCI::class, FacilitiesMonitoring::class.'::functionalci_id = id')
    ->where(FunctionalCI::class.'::obsolescence_flag', OrmOperator::EQUALS, '0')
    ->andWhere('status', OrmOperator::EQUALS, StatusEnum::ACTIVE)
    ->execute();

//OrmFactory::getSalesforce()
//	->select('id')
//	->from(SalesforceCustomModel::class)
//	->where('id', OrmOperator::EQUALS, 23)
//	->andWhere('name', OrmOperator::EQUALS, 'test')
//	->andWhere('email')->notLike(Like::endsWith('@gmail.fr'));
//
//OrmFactory::getLdap()
//	->select('id')
//	->from(LdapCustomModel::class)
//	->where('id', OrmOperator::EQUALS, 23)
//	->andWhere('name', OrmOperator::EQUALS, 'test')
//	->andWhere('email')->notLike(Like::endsWith('@gmail.fr'));
//
//OrmFactory::getActiveDirectory()
//	->select('id')
//	->from(ActiveDirectoryCustomModel::class)
//	->where('id', OrmOperator::EQUALS, 23)
//	->andWhere('name', OrmOperator::EQUALS, 'test')
//	->andWhere('email')->notLike(Like::endsWith('@gmail.fr'));
//
//OrmFactory::getCustom(CustomClass::class)
//	->select('id')
//	->from(CustomModel::class)
//	->where('id', OrmOperator::EQUALS, 23)
//	->andWhere('name', OrmOperator::EQUALS, 'test')
//	->andWhere('email')->notLike(Like::endsWith('@gmail.fr'));