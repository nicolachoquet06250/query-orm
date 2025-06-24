<?php

namespace examples\customQuery;

use QueryOrm\ModelSelectorInterface;
use QueryOrm\OrmQueryExecutor;
use QueryOrm\Query;
use QueryOrm\Runner;

/**
 * @template T of CustomModel
 */
class CustomModelSelector implements ModelSelectorInterface, Query, Runner
{
    /** @property CustomModel $model */
    private $model;

    /** @var string[] $fields */
    private array $fields;

    public function __construct(string ...$fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param CustomModel $model
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

    public function build(): OrmQueryExecutor
    {
        return new CustomQueryExecutor($this->getQl());
    }
}