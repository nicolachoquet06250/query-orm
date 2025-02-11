<?php

use QueryOrm\ModelSelectorInterface;
use QueryOrm\Query;
use QueryOrm\Runner;

/**
 * @template T of CustomModel
 */
class CustomModelSelector implements ModelSelectorInterface, Query, Runner
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
	 * @return CustomSelector
	 */
	public function from($model): CustomSelector
	{
		$this->model = $model;
		return new CustomSelector(...$this->fields);
	}

	public function getQl(): string
	{
		return "SELECT " . implode(", ", $this->fields) . " FROM " . $this->model->table;
	}

	public function execute()
	{
		// TODO: Implement execute() method.
	}
}