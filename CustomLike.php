<?php


use QueryOrm\itop\ItopSelector;
use QueryOrm\LikeInterface;
use QueryOrm\OrmSelectorInterface;

readonly class CustomLike implements LikeInterface
{
	public function __construct(
		private CustomSelector $selector
	)
	{}

	public function like(string $pattern): CustomSelector
	{
		return ($this->selector)('like', $pattern);
	}

	public function notLike(string $pattern): CustomSelector
	{
		return ($this->selector)('not_like', $pattern);
	}
}