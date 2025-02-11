<?php

namespace QueryOrm\itop;

use QueryOrm\OrmBaseInterface;

class ItopOrm implements OrmBaseInterface
{
    protected array $fields = [];

	public function select(string ...$fields): ItopModelSelector
	{
        $this->fields = $fields;
		return new ItopModelSelector(...$fields);
	}
}