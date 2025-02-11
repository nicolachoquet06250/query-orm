<?php

namespace QueryOrm\itop;

use QueryOrm\LikeInterface;

readonly class ItopLike implements LikeInterface
{
	public function __construct(
		private ItopSelector $selector
	)
	{}

	public function like(string $pattern): ItopSelector
	{
		return ($this->selector)('like', $pattern);
	}

	public function notLike(string $pattern): ItopSelector
	{
		return ($this->selector)('not_like', $pattern);
	}
}