<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SyntaxSolutions\CsvBuilder\CsvBuilder;
use SyntaxSolutions\CsvBuilder\CsvRow;

$builder = new CsvBuilder();

$headers = new CsvRow();
$headers->addCell("Header 1");
$headers->addCell("Header 2");
$headers->addCell("Header 3");
$builder->addHeaders($headers);

$row = new CsvRow();
$row->addCell("Cell 1");
$row->addCell("Cell 2");
$row->addCell("Cell 3");
$builder->addRow($row);

echo $builder->getBytes();