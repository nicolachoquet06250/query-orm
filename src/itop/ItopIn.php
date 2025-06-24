<?php

namespace QueryOrm\itop;

use QueryOrm\InInterface;
use QueryOrm\OrmSelectorInterface;

class ItopIn implements InInterface
{
    public function __construct(
        private readonly ItopSelector $selector
    )
    {}

    public function in(...$values): ItopSelector
    {
        return ($this->selector)('in', $values);
    }

    public function notIn(...$values): ItopSelector
    {
        return ($this->selector)('not_in', $values);
    }
}