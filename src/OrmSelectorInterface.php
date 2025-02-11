<?php

namespace QueryOrm;

interface OrmSelectorInterface
{
	public function __construct(
        string $model,
        string ...$fields
    );

//	public function from($model): static;

	public function where(
		string $property,
		?OrmOperator $operator = null,
		?string $value = null
	): static|LikeInterface;

	public function andWhere(
		string $property,
		?OrmOperator $operator = null,
		?string $value = null
	): static|LikeInterface;

	public function orWhere(
		string $property,
		?OrmOperator $operator = null,
		?string $value = null
	): static|LikeInterface;

	public function __invoke(string $operationType, ...$args): static;
}