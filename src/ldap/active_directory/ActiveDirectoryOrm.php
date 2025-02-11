<?php

namespace QueryOrm\ldap\active_directory;

use QueryOrm\ldap\LdapOrm;

class ActiveDirectoryOrm extends LdapOrm
{
	public function select(string ...$fields): ActiveDirectoryModelSelector
	{
		parent::select(...$fields);
		return new ActiveDirectoryModelSelector();
	}
}