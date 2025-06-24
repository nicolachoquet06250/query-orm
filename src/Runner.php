<?php

namespace QueryOrm;

interface Runner
{
	public function build(): OrmQueryExecutor;
}