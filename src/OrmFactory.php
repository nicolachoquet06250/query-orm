<?php

namespace QueryOrm;
use QueryOrm\itop\ItopOrm;
use QueryOrm\ldap\active_directory\ActiveDirectoryOrm;
use QueryOrm\ldap\LdapOrm;
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

	public static function getLdap(): LdapOrm
	{
		return new LdapOrm();
	}

	public static function getActiveDirectory(): ActiveDirectoryOrm
	{
		return new ActiveDirectoryOrm();
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
