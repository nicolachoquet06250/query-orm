<?php

namespace examples\customQuery;

use QueryOrm\OrmOperator;
use QueryOrm\OrmSelectorInterface;

class CustomSelector implements OrmSelectorInterface
{
    /** @var string[] $fields */
    private array $fields;

    public function __construct(string ...$fields)
    {
        $this->fields = $fields;
    }

    public function where(string $property, ?OrmOperator $operator = null, ?string $value = null): static|CustomLike
    {
        // TODO: Implement where() method.
        if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
            return new CustomLike($this);
        }
        return $this;
    }

    public function andWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|CustomLike
    {
        // TODO: Implement andWhere() method.
        if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
            return new CustomLike($this);
        }
        return $this;
    }

    public function orWhere(string $property, ?OrmOperator $operator = null, ?string $value = null): static|CustomLike
    {
        // TODO: Implement orWhere() method.
        if (($operator === OrmOperator::LIKE || $operator === OrmOperator::NOT_LIKE || empty($operator)) && empty($value)) {
            return new CustomLike($this);
        }
        return $this;
    }

    public function __invoke(string $operationType, ...$args): static
    {
        // TODO: Implement __invoke() method.
        return $this;
    }
}