<?php

use QueryOrm\itop\ItopModel;

class ItopCustomModel extends ItopModel
{
    public string $alias {
        get => 'ICM';
    }

	public function __construct(
		private(set) readonly string $id
	)
	{}
}