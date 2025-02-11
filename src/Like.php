<?php

namespace QueryOrm;

class Like
{
	public static function startsWith(string $pattern): string
	{
		return "{$pattern}%";
	}
	public static function endsWith(string $pattern): string
	{
		return "%{$pattern}";
	}
	public static function contains(string $pattern): string
	{
		return "%{$pattern}%";
	}
	public static function customPattern(string ...$pattern): string
	{
		return implode('%', $pattern);
	}
}