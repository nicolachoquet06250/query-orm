<?php

namespace QueryOrm\ldap;

use QueryOrm\ModelSelectorInterface;
use QueryOrm\Query;
use QueryOrm\Runner;

/**
 * @template T of LdapModel
 */
class LdapModelSelector implements ModelSelectorInterface, Runner
{
	/** @property T $model */
	private $model;

	/** @var string[] $fields */
	private array $fields;

	public function __construct(string ...$fields)
	{
		$this->fields = $fields;
	}

	/**
	 * @param T $model
	 * @return LdapSelector
	 */
	public function from($model): LdapSelector
	{
		$this->model = $model;
		return new LdapSelector(...$this->fields);
	}

	public function execute()
	{
		// TODO: Implement execute() method.
	}
}