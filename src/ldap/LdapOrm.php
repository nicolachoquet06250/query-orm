<?php

namespace QueryOrm\ldap;

use QueryOrm\OrmBaseInterface;

class LdapOrm implements OrmBaseInterface
{
	public function select(string ...$fields): LdapModelSelector
	{
		var_dump(get_class($this));
		// TODO: Implement select() method.
		return new LdapModelSelector(...$fields);
	}
}