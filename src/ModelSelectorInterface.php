<?php

namespace QueryOrm;

interface ModelSelectorInterface
{
	public function __construct(string ...$fields);

	public function from($model): OrmSelectorInterface;
}