<?php

namespace QueryOrm\salesforce;

use QueryOrm\OrmBaseInterface;

class SalesforceOrm implements OrmBaseInterface
{
    protected array $fields = [] {
        get => array_map(fn(string $field) => ucfirst($field), $this->fields);
        set => $this->fields = $value;
    }

    public function select(string ...$fields): SalesforceModelSelector
	{
        $this->fields = $fields;
		return new SalesforceModelSelector(...$this->fields);
	}
}