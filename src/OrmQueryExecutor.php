<?php

namespace QueryOrm;

/**
 * @template T as Model
 */
interface OrmQueryExecutor
{
    public function __construct(string $query);

    public function execute(): static;

    /** @return array[] */
    public function toArray(): array;

    /** @return T[] */
    public function toModels(): array;

    public function getCount(): int;

    public function getError(): ?string;
}