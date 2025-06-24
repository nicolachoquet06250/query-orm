<?php

namespace QueryOrm\salesforce;

use QueryOrm\ExpressionCalculator;
use QueryOrm\OrmOperator;
use QueryOrm\OrmSelectorInterface;
use QueryOrm\Query;
use QueryOrm\Runner;
use ReflectionClass;
use ReflectionException;
use ReflectionObject;

class SalesforceSelector extends ExpressionCalculator implements OrmSelectorInterface, Query, Runner
{
	/** @var string[] $fields */
	private array $fields;
    protected array $joinedModels = [];
    private array $where = [];

	public function __construct(
        private readonly string $model,
        string ...$fields
    )
	{
		$this->fields = $fields;
	}

    public function where(string $property, ?OrmOperator $operator = null, ?string $value = null): static|SalesforceLike/*|ItopIn*/
    {
        $this->where[] = [
            'property' => $property
        ];
        if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
            return new SalesforceLike($this);
        }
        /*if (($operator === OrmOperator::IN || $operator === OrmOperator::NOT_IN || empty($operator)) && empty($value)) {
            return new ItopIn($this);
        }*/
        $this->where[array_key_last($this->where)]['operator'] = $operator;
        $this->where[array_key_last($this->where)]['value'] = $value;

        return $this;
    }

	public function andWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|SalesforceLike
	{
        $this->where[] = [
            'previousLogicOperator' => 'AND',
            'property' => $property
        ];
        if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
            return new SalesforceLike($this);
        }
        /*if (($operator === OrmOperator::IN || $operator === OrmOperator::NOT_IN || empty($operator)) && empty($value)) {
            return new ItopIn($this);
        }*/
        $this->where[array_key_last($this->where)]['operator'] = $operator;
        $this->where[array_key_last($this->where)]['value'] = $value;

        return $this;
	}

	public function orWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|SalesforceLike
	{
        $this->where[] = [
            'previousLogicOperator' => 'OR',
            'property' => $property
        ];
        if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
            return new SalesforceLike($this);
        }
        /*if (($operator === OrmOperator::IN || $operator === OrmOperator::NOT_IN || empty($operator)) && empty($value)) {
            return new ItopIn($this);
        }*/
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

    /**
     * @throws ReflectionException
     */
    public function getQl(): string
	{
        $r = new ReflectionClass($this->model);
        $model = $r->newInstanceWithoutConstructor();

        $baseTable = $model->table ?? basename($this->model);
        $baseAlias = $model->alias ?? substr($baseTable, 0, 1);

        $query = "SELECT " . implode(', ', $this->fields) . " FROM ";

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

            $where['property'] = $this->calculExpression($where['property']);

            $isEnumValue = is_object($where['value']) && new ReflectionObject($where['value'])->isEnum();

            $where['operator'] = is_string($where['operator']) ? strtoupper($where['operator']) : $where['operator']->value;

            $where['value'] = is_string($where['value']) || str_contains($where['operator'], 'LIKE')
                ? "'{$where['value']}'"
                : ($isEnumValue
                    ? "'{$where['value']->value}'"
                    : (str_contains($where['operator'], 'IN') ? "(".implode(',', array_map(fn($v) => is_string($v) ? "'{$v}'" : $v, $where['value'])).")" : $where['value']));

            $expression = "{$where['property']} {$where['operator']} {$where['value']}";
            $query .= " {$expression}";
        }

        $_query = explode('WHERE ', $query);

        $p1 = $_query[0];
        $p2 = $_query[1] ?? '';

        $ps = explode(' AND ', $p2);
        $q = [];
        foreach ($ps as $p) {
            $q[] = str_contains($p, ' OR ') ? "({$p})" : $p;
        }

        if (!empty($p2)) {
            $p2 = "WHERE " . implode(' AND ', $q);
        }

        return "{$p1}{$p2}";
	}

    /**
     * @throws ReflectionException
     */
    public function build(): SalesforceQueryExecutor
    {
        return new SalesforceQueryExecutor($this->getQl());
	}
}