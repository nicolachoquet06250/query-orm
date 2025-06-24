<?php

namespace QueryOrm;

interface InInterface
{
    public function in(mixed ...$values): OrmSelectorInterface;
    public function notIn(mixed ...$values): OrmSelectorInterface;
}