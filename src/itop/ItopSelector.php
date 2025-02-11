<?php

namespace QueryOrm\itop;

use QueryOrm\Model;
use QueryOrm\OrmOperator;
use QueryOrm\OrmSelectorInterface;
use QueryOrm\Query;
use QueryOrm\Runner;
use ReflectionClass;
use ReflectionException;

class ItopSelector implements OrmSelectorInterface, Query, Runner
{
	/** @var string[] $fields */
	private array $fields;
    private array $joinedModels = [];

	public function __construct(
        private readonly string $model,
        string ...$fields
    )
	{
		$this->fields = $fields;
	}

    public function join(string $model, string $on): static
    {
        $this->joinedModels[$model] = $on;
        return $this;
    }

	public function where(string $property, ?OrmOperator $operator = null, ?string $value = null): static|ItopLike
	{
		// TODO: Implement where() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new ItopLike($this);
		}
		return $this;
	}

	public function andWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|ItopLike
	{
		// TODO: Implement andWhere() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new ItopLike($this);
		}
		return $this;
	}

	public function orWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|ItopLike
	{
		// TODO: Implement orWhere() method.
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new ItopLike($this);
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
        $r = new ReflectionClass($this->model);
        $model = $r->newInstanceWithoutConstructor();

        $baseTable = $model->table;
        $baseAlias = $model->alias;

		$query = "SELECT ";

        if (count($this->joinedModels) >= 1) {
            $query .= $baseAlias;
            foreach ($this->joinedModels as $model => $on) {
                $r = new ReflectionClass($model);
                $model = $r->newInstanceWithoutConstructor();

                $alias = $model->alias;
                $query .= ", " . $alias. " ";
            }
            $query .= "FROM {$baseTable} AS {$baseAlias} JOIN ";
            foreach ($this->joinedModels as $model => $on) {
                preg_match('/^(?<model1>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::[$]?(?<property1>[a-z0-1_]*) ?(?<operator>=|!=|<|>|<=|>=) ?(?<model2>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::[$]?(?<property2>[a-z0-1_]*)$/', $on, $matches);
                [
                    'model1' => $model1,
                    'property1' => $property1,
                    'model2' => $model2,
                    'property2' => $property2
                ] = $matches;

                if ($model1 === $this->model || in_array($model1, array_keys($this->joinedModels))) {
                    $r = new ReflectionClass($model1);
                    $m = $r->newInstanceWithoutConstructor();

                    $on = str_replace($baseTable, $baseAlias, $on);

                    $on = str_replace($model1, $m->alias, $on);
                    $on = str_replace("\${$property1}", $property1, $on);

                    $r = new ReflectionClass($model2);
                    $m = $r->newInstanceWithoutConstructor();

                    $on = str_replace($model2, $m->alias, $on);
                    $on = str_replace("\${$property2}", $property2, $on);

                    $on = str_replace("::", ".", $on);
                }

                $r = new ReflectionClass($model);
                $m = $r->newInstanceWithoutConstructor();

                $query .= "{$model} AS {$m->alias} ON {$on},";
            }

            $query = substr($query, 0, -1);
        }
        else {
            $query .= "{$baseTable} AS {$baseAlias}";
        }

//        $query .= $baseAlias;

        return $query;
	}

	public function execute()
	{
		var_dump($this->getQl());
	}
}