<?php

namespace QueryOrm;

interface OrmBaseInterface
{
	public function select(string ...$fields): ModelSelectorInterface;
}