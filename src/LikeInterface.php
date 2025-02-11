<?php

namespace QueryOrm;

interface LikeInterface
{
	public function like(string $pattern): OrmSelectorInterface;
	public function notLike(string $pattern): OrmSelectorInterface;
}