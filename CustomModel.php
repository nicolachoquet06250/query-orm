<?php

use QueryOrm\itop\ItopModel;

class CustomModel extends ItopModel
{
	public function __construct(
		private(set) readonly string $id
	)
	{}
}