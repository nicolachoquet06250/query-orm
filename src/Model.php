<?php

namespace QueryOrm;

class Model
{
	public string $alias {
        get => $value ?? substr($this->table, 0, 1);
    }

	public string $table {
        get => $value ?? get_class($this);
    }
}