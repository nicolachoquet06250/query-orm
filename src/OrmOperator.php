<?php

namespace QueryOrm;
enum OrmOperator: string
{
	case EQUALS = '=';
	case DIFF = '!=';
	case SUP = '>';
	case SUP_EQUALS = '>=';
	case INF = '<';
	case INF_EQUALS = '<=';
	case IN = 'IN';
	case NOT_IN = 'NOT IN';
	case LIKE = 'LIKE';
	case NOT_LIKE = 'NOT LIKE';
}
