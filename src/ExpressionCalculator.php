<?php

namespace QueryOrm;

use ReflectionClass;
use ReflectionException;

class ExpressionCalculator
{
    protected array $joinedModels = [];

    /**
     * @throws ReflectionException
     */
    protected function calculExpression(string $expression): string
    {
        $r = new ReflectionClass(static::class);
        $model = $r->newInstanceWithoutConstructor();

        $baseTable = $model->table ?? basename($model::class);
        $baseAlias = $model->alias ?? substr($baseTable, 0, 1);

        if (!preg_match('/^((?<model>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::)?[$]?(?<property>[a-z0-1_]*)/m', $expression, $matches)) return $expression;

        [
            'model' => $model,
            'property' => $property
        ] = $matches;

        if ($model === static::class || in_array($model, array_keys($this->joinedModels))) {
            $r = new ReflectionClass($model);
            $m = $r->newInstanceWithoutConstructor();

            $expression = str_replace($model, $m->alias, $expression);
            $expression = str_replace("\${$property}", $property, $expression);

            $expression = str_replace("::", ".", $expression);

            $expression = str_replace($baseTable, $baseAlias, $expression);
        }
        elseif (empty($model) && !empty($property)) {
            $expression = "{$baseAlias}.{$property}";
        }

        return str_replace('::', '.', $expression);
    }

    /**
     * @throws ReflectionException
     */
    protected function calculEquation(string $expression): string
    {
        preg_match(
            '/^(?<left>((?<model1>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::)?[$]?(?<property1>[a-z0-1_]*)) ?(?<operator>=|!=|<|>|<=|>=) ?(?<right>((?<model2>([a-zA-Z\\\\]*\\\\)?[A-Z][a-zA-Z0-9]*)::)?[$]?(?<property2>[a-z0-1_]*))$/',
            $expression,
            $matches
        );

        $f = array_filter($matches, fn ($k) => is_string($k), ARRAY_FILTER_USE_KEY);

        [
            'left' => $left,
            'operator' => $operator,
            'right' => $right,
        ] = [
            'left' => $f['left'] ?? '',
            'operator' => $f['operator'] ?? '',
            'right' => $f['right'] ?? '',
        ];

        return str_replace('::', '.', "{$this->calculExpression($left)} {$operator} {$this->calculExpression($right)}");
    }
}