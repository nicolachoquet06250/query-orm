<?php

namespace QueryOrm\salesforce;

use QueryOrm\Model;
use QueryOrm\OrmOperator;
use QueryOrm\OrmSelectorInterface;
use QueryOrm\Query;
use QueryOrm\Runner;

class SalesforceSelector implements OrmSelectorInterface, Query, Runner
{
	/** @var string[] $fields */
	private array $fields;

	public function __construct(
        private readonly string $model,
        string ...$fields
    )
	{
		$this->fields = $fields;
	}

	public function where(string $property, ?OrmOperator $operator = null, ?string $value = null): static|SalesforceLike
	{
		// TODO: Implement where() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new SalesforceLike($this);
		}
		return $this;
	}

	public function andWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|SalesforceLike
	{
		// TODO: Implement andWhere() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new SalesforceLike($this);
		}
		return $this;
	}

	public function orWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|SalesforceLike
	{
		// TODO: Implement orWhere() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new SalesforceLike($this);
		}
		return $this;
	}

	public function __invoke(string $operationType, ...$args): static
	{
		// TODO: Implement __invoke() method.
		return $this;
	}

	public function getQl(): string
	{
		return 'SELECT ' . implode(', ', array_map(fn(string $k) => ucfirst($k), $this->fields)) . ' FROM ' . $this->model->table;
	}

	public function execute()
	{
		// TODO: Implement execute() method.
	}
}