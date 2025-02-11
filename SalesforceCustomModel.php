<?php

use QueryOrm\salesforce\SalesforceModel;

class SalesforceCustomModel extends SalesforceModel
{
	public function __construct(
		private(set) readonly string $id
	)
	{}
}