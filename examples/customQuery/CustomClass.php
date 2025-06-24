<?php

namespace examples\customQuery;

use QueryOrm\OrmBaseInterface;

class CustomClass implements OrmBaseInterface
{
    public function select(string ...$fields): CustomModelSelector
    {
        var_dump(get_class($this));
        // TODO: Implement select() method.
        return new CustomModelSelector();
    }
}