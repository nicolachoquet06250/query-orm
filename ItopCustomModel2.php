<?php

use QueryOrm\itop\ItopModel;

class ItopCustomModel2 extends ItopModel
{
    public string $alias {
        get => 'ICM2';
    }

	public function __construct(
		private(set) readonly string $id,
        private(set) string $table1_id,
	)
	{}
}