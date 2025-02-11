<?php

namespace QueryOrm;

enum StatusEnum: string
{
    case IMPLEMENTATION = 'implementation';
    case OPSOLETE = 'opsolete';
    case DECOMMISSIONING = 'decommissioning';
    case PRODUCTION = 'production';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
