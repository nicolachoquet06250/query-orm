<?php

namespace QueryOrm\salesforce;

use QueryOrm\ModelSelectorInterface;
use QueryOrm\Query;
use QueryOrm\Runner;

/**
 * @template T of SalesforceModel
 */
class SalesforceModelSelector implements ModelSelectorInterface
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
	 * @return SalesforceSelector
	 */
	public function from($model): SalesforceSelector
	{
		$this->model = $model;
		return new SalesforceSelector(...$this->fields);
	}
}