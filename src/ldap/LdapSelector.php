<?php

namespace QueryOrm\ldap;

use QueryOrm\Model;
use QueryOrm\OrmOperator;
use QueryOrm\OrmSelectorInterface;
use QueryOrm\Runner;

class LdapSelector implements OrmSelectorInterface, Runner
{
	/** @var string[] $fields */
	private array $fields;

	public function __construct(string $model, string ...$fields)
	{
		$this->fields = $fields;
	}

	public function where(string $property, ?OrmOperator $operator = null, ?string $value = null): static|LdapLike
	{
		// TODO: Implement where() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new LdapLike($this);
		}
		return $this;
	}

	public function andWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|LdapLike
	{
		// TODO: Implement andWhere() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new LdapLike($this);
		}
		return $this;
	}

	public function orWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|LdapLike
	{
		// TODO: Implement orWhere() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new LdapLike($this);
		}
		return $this;
	}

	public function __invoke(string $operationType, ...$args): static
	{
		// TODO: Implement __invoke() method.
		return $this;
	}

	public function execute()
	{
		// TODO: Implement execute() method.
	}
}