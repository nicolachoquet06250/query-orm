<?php

namespace QueryOrm\ldap;

use QueryOrm\LikeInterface;

readonly class LdapLike implements LikeInterface
{
	public function __construct(
		private LdapSelector $selector
	)
	{}

	public function like(string $pattern): LdapSelector
	{
		return ($this->selector)('like', $pattern);
	}

	public function notLike(string $pattern): LdapSelector
	{
		return ($this->selector)('not_like', $pattern);
	}
}