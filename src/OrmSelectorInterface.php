<?php

namespace QueryOrm;

interface OrmSelectorInterface
{
	public function __construct(
        string $model,
        string ...$fields
    );

	public function where(
		string $property,
		?OrmOperator $operator = null,
		?string $value = null
	): static|LikeInterface|InInterface;

	public function andWhere(
		string $property,
		?OrmOperator $operator = null,
		?string $value = null
	): static|LikeInterface|InInterface;

	public function orWhere(
		string $property,
		?OrmOperator $operator = null,
		?string $value = null
	): static|LikeInterface|InInterface;

	public function __invoke(string $operationType, ...$args): static;
}