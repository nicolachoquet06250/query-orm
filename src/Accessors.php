<?php

namespace QueryOrm;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Accessors
{
    public function __construct(
        public readonly string $getter = '',
        public readonly string $setter = ''
    )
    {}
}