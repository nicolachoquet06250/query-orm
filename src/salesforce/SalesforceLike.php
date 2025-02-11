<?php

namespace QueryOrm\salesforce;

use QueryOrm\itop\ItopSelector;
use QueryOrm\LikeInterface;
use QueryOrm\OrmSelectorInterface;

readonly class SalesforceLike implements LikeInterface
{
	public function __construct(
		private SalesforceSelector $selector
	)
	{}

	public function like(string $pattern): SalesforceSelector
	{
		return ($this->selector)('like', $pattern);
	}

	public function notLike(string $pattern): SalesforceSelector
	{
		return ($this->selector)('not_like', $pattern);
	}
}