<?php

namespace QueryOrm\itop;

use QueryOrm\itop\ItopModel as T;
use QueryOrm\ModelSelectorInterface;
use QueryOrm\Query;
use QueryOrm\Runner;

/**
 * @template T of ItopModel
 */
class ItopModelSelector implements ModelSelectorInterface
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
	 * @return ItopSelector
	 */
	public function from($model): ItopSelector
	{
		$this->model = $model;
		return new ItopSelector($this->model, ...$this->fields);
	}
}