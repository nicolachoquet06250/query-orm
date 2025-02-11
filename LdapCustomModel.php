<?php

use QueryOrm\ldap\LdapModel;

class LdapCustomModel extends LdapModel
{
	public function __construct(
		private(set) readonly string $id
	)
	{}
}