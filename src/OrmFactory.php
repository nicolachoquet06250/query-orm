<?php

namespace QueryOrm;

use QueryOrm\itop\ItopOrm;
use QueryOrm\salesforce\SalesforceOrm;

class OrmFactory
{
	public static function getItop(): ItopOrm
	{
		return new ItopOrm();
	}

	public static function getSalesforce(): SalesforceOrm
	{
		return new SalesforceOrm();
	}

	/**
	 * @template T of OrmBaseInterface
	 * @param T $class
	 * @return T
	 */
	public static function getCustom($class)
	{
		return new $class();
	}
}
