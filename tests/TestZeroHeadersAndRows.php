<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SyntaxSolutions\CsvBuilder\CsvBuilder;
use SyntaxSolutions\CsvBuilder\CsvRow;

$builder = new CsvBuilder();
echo $builder->getBytes();