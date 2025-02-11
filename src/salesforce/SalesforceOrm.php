<?php

namespace QueryOrm\salesforce;

use QueryOrm\OrmBaseInterface;

class SalesforceOrm implements OrmBaseInterface
{
	public function select(string ...$fields): SalesforceModelSelector
	{
		var_dump(get_class($this));
		// TODO: Implement select() method.
		return new SalesforceModelSelector(...$fields);
	}
}