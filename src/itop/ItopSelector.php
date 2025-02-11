<?php

namespace QueryOrm\itop;

use QueryOrm\Model;
use QueryOrm\OrmOperator;
use QueryOrm\OrmSelectorInterface;
use QueryOrm\Query;
use QueryOrm\Runner;
use ReflectionClass;
use ReflectionException;
use ReflectionObject;

class ItopSelector implements OrmSelectorInterface, Query, Runner
{
	/** @var string[] $fields */
	private array $fields;
    private array $joinedModels = [];
    private array $where = [];

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
        $this->where[] = [
            'property' => $property
        ];
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new ItopLike($this);
		}
        $this->where[array_key_last($this->where)]['operator'] = $operator;
        $this->where[array_key_last($this->where)]['value'] = $value;

		return $this;
	}

	public function andWhere(string $property, ?OrmOperator $operator = null, mixed $value = null): static|ItopLike
	{
        $this->where[] = [
            'previousLogicOperator' => 'AND',
            'property' => $property
        ];
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new ItopLike($this);
		}
        $this->where[array_key_last($this->where)]['operator'] = $operator;
        $this->where[array_key_last($this->where)]['value'] = $value;

		return $this;
	}

	public function orWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|ItopLike
	{
        $this->where[] = [
            'previousLogicOperator' => 'OR',
            'property' => $property
        ];
		if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
			return new ItopLike($this);
		}
        $this->where[array_key_last($this->where)]['operator'] = $operator;
        $this->where[array_key_last($this->where)]['value'] = $value;

		return $this;
	}

	public function __invoke(string $operationType, ...$args): static
	{
        $this->where[array_key_last($this->where)]['operator'] = str_replace('_', ' ', $operationType);
        $this->where[array_key_last($this->where)]['value'] = $args[0];

		return $this;
	}

    private function calculOneExpression(string $expression): string
    {
        $r = new ReflectionClass($this->model);
        $model = $r->newInstanceWithoutConstructor();

        $baseTable = $model->table;
        $baseAlias = $model->alias;

        if (!preg_match('/(?<model>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::[$]?(?<property>[a-z0-1_]*)/', $expression, $matches)) return $expression;

        [
            'model' => $model,
            'property' => $property
        ] = $matches;

        if ($model === $this->model || in_array($model, array_keys($this->joinedModels))) {
            $r = new ReflectionClass($model);
            $m = $r->newInstanceWithoutConstructor();

            $expression = str_replace($baseTable, $baseAlias, $expression);

            $expression = str_replace($model, $m->alias, $expression);
            $expression = str_replace("\${$property}", $property, $expression);

            $expression = str_replace("::", ".", $expression);
        }

        return $expression;
    }

    private function calculEquation(string $expression): string
    {
        $r = new ReflectionClass($this->model);
        $model = $r->newInstanceWithoutConstructor();

        $baseTable = $model->table;
        $baseAlias = $model->alias;

        preg_match('/^((?<model1>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::)?[$]?(?<property1>[a-z0-1_]*) ?(?<operator>=|!=|<|>|<=|>=) ?((?<model2>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::)?[$]?(?<property2>[a-z0-1_]*)$/', $expression, $matches);

        [
            'model1' => $model1,
            'property1' => $property1,
            'model2' => $model2,
            'property2' => $property2
        ] = [
            'model1' => $matches['model1'] ?? '',
            'model2' => $matches['model2'] ?? '',
            'property1' => $matches['property1'] ?? '',
            'property2' => $matches['property2'] ?? ''
        ];

        if ($model1 === $this->model || in_array($model1, array_keys($this->joinedModels))) {
            $r = new ReflectionClass($model1);
            $m = $r->newInstanceWithoutConstructor();

            $expression = str_replace($baseTable, $baseAlias, $expression);

            $expression = str_replace($model1, $m->alias, $expression);
            $expression = str_replace("\${$property1}", $property1, $expression);
        }

        if ($model2 === $this->model || in_array($model2, array_keys($this->joinedModels))) {
            $r = new ReflectionClass($model2);
            $m = $r->newInstanceWithoutConstructor();

            $expression = str_replace($model2, $m->alias, $expression);
            $expression = str_replace("\${$property2}", $property2, $expression);
        }

        if (!$model1) {
            $expression = str_replace($property1, "{$baseAlias}.{$property1}", $expression);
        }

        if (!$model2) {
            $expression = str_replace($property2, "{$baseAlias}.{$property2}", $expression);
        }

        return str_replace("::", ".", $expression);
    }

    /**
     * @throws ReflectionException
     */
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
                /*preg_match('/^(?<model1>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::[$]?(?<property1>[a-z0-1_]*) ?(?<operator>=|!=|<|>|<=|>=) ?(?<model2>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::[$]?(?<property2>[a-z0-1_]*)$/', $on, $matches);
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
                }

                if ($model2 === $this->model || in_array($model2, array_keys($this->joinedModels))) {
                    $r = new ReflectionClass($model2);
                    $m = $r->newInstanceWithoutConstructor();

                    $on = str_replace($model2, $m->alias, $on);
                    $on = str_replace("\${$property2}", $property2, $on);
                }

                $on = str_replace("::", ".", $on);*/

                $on = $this->calculEquation($on);

                $r = new ReflectionClass($model);
                $m = $r->newInstanceWithoutConstructor();

                $query .= "{$model} AS {$m->alias} ON {$on},";
            }

            $query = substr($query, 0, -1);
        }
        else {
            $query .= "{$baseTable} AS {$baseAlias}";
        }

        if (!empty($this->where)) {
            $query .= " WHERE";
        }

        foreach ($this->where as $where) {
            if (isset($where['previousLogicOperator'])) {
                $query .= " {$where['previousLogicOperator']}";
            }
            $where['property'] = $this->calculOneExpression($where['property']);
            $isEnumValue = is_object($where['value']) && new ReflectionObject($where['value'])->isEnum();
            $where['operator'] = is_string($where['operator']) ? strtoupper($where['operator']) : $where['operator']->value;
            $expressionStart = $this->calculEquation("{$where['property']} {$where['operator']} ");
            $expression = $expressionStart . (str_contains($where['operator'], 'LIKE') || $isEnumValue
                    ? "'{$where['value']->value}'"
                    : (str_contains($where['operator'], 'LIKE')
                        ? "'{$where['value']}'" : $where['value']));
            $query .= " {$expression}";
        }

        return $query;
	}

	public function execute()
	{
		var_dump($this->getQl());
	}
}