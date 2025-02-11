<?php

use QueryOrm\{
	Like,
	OrmFactory,
	OrmOperator
};

require_once 'vendor/autoload.php';

$customModel1 = ItopCustomModel::class;
$customModel2 = ItopCustomModel2::class;
OrmFactory::getItop()
	->select('id')
	->from(ItopCustomModel::class)
    ->join(ItopCustomModel2::class, "{$customModel1}::id = {$customModel2}::table1_id")
    ->where(ItopCustomModel::class.'::id', OrmOperator::SUP, 12)
    ->andWhere(ItopCustomModel::class.'::test')->like(Like::customPattern('test%'))
    ->execute();
//	->where('id', OrmOperator::EQUALS, 23)
//	->andWhere('name', OrmOperator::EQUALS, 'test')
//	->andWhere('email')->notLike(Like::endsWith('@gmail.fr'));

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