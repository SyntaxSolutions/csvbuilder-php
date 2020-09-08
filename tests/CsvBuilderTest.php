<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SyntaxSolutions\CsvBuilder\CsvBuilder;
use SyntaxSolutions\CsvBuilder\CsvRow;

$builder = new CsvBuilder();

$headers = new CsvRow();
$headers->addCell("Header 1");
$headers->addCell("Header 2");
$headers->addCell("Header 3");
$headers->addCell("Header 4");
$headers->addCell(" Header 5");
$headers->addCell("Header 6 ");
$headers->addCell("Header 7");
$builder->addHeaders($headers);

$row = new CsvRow();
$row->addCell("Cell 1 \"with quotes\"");
$row->addCell("Cell 2 with line break 1\r\nline break 2");
$row->addCell("Cell 3");
$row->addCell("Cell, with, commas");
$row->addCell(" leading space");
$row->addCell("trailing space ");
$row->addCell(null);
$builder->addRow($row);

echo $builder->getBytes();