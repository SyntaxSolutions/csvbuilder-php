<?php
namespace SyntaxSolutions\CsvBuilder;

class CsvRow
{
    public $cells;

    /**
     * CsvRow constructor.
     * @param array $options
     */
    public function __construct()
    {
        $this->cells = [];
    }

    /**
     * Add cell text
     * @param $text
     */
    public function addCell($text)
    {
        $this->cells[] = "\"{$text}\"";
    }
}