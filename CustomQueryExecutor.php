<?php

class CustomQueryExecutor implements \QueryOrm\OrmQueryExecutor
{

    public function __construct(string $query)
    {
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
        return [];
    }

    /**
     * @inheritDoc
     */
    public function toModels(): array
    {
        return [];
    }

    public function getCount(): int
    {
        return 0;
    }

    public function getError(): ?string
    {
        return null;
    }
}