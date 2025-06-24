<?php

namespace QueryOrm\salesforce;

use QueryOrm\OrmQueryExecutor;

class SalesforceQueryExecutor implements OrmQueryExecutor
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

    public function toArray(): array
    {
        return $this->results;
    }

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