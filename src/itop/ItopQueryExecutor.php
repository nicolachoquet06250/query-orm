<?php

namespace QueryOrm\itop;

use QueryOrm\OrmQueryExecutor;

/**
 * @implements OrmQueryExecutor<ItopModel>
 */
class ItopQueryExecutor implements OrmQueryExecutor
{
    protected array $results = [];

    public function __construct(
        protected string $query
    ) {
        var_dump($query);
    }

    public function execute(): static
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->results;
    }

    /**
     * @inheritDoc
     */
    public function toModels(): array
    {
        return $this->results;
    }

    public function getError(): ?string
    {
        return null;
    }

    public function getCount(): int
    {
        return count($this->results);
    }
}