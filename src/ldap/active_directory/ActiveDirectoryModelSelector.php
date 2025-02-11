<?php

namespace QueryOrm\ldap\active_directory;

use QueryOrm\ldap\LdapModel;
use QueryOrm\ldap\LdapModelSelector;

/**
 * @template T of LdapModel
 */
class ActiveDirectoryModelSelector extends LdapModelSelector
{
	/** @property T $model */
	private $model;

	/** @var string[] $fields */
	private array $fields;

	public function __construct(string ...$fields)
	{
		parent::__construct(...$fields);
		$this->fields = $fields;
	}

	/**
	 * @param T $model
	 * @return ActiveDirectorySelector
	 */
	public function from($model): ActiveDirectorySelector
	{
		$this->model = $model;
		return new ActiveDirectorySelector($model, ...$this->fields);
	}
}