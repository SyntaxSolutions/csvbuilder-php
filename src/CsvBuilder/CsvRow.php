<?php
namespace SyntaxSolutions\CsvBuilder;

class CsvRow
{
    public $cells;

    /**
     * Create a new CsvRow
     * @param array $options
     */
    public function __construct()
    {
        $this->cells = [];
    }

    /**
     * Add text to row cell
     * @param $text
     */
    public function addCell($text)
    {
        $formatted_text = null;
        if (!strlen($text))
        {
            $formatted_text = '';
        }
        else
        {
            $formatted_text = str_replace('"', '""', $text);

            if (strpos($formatted_text, '"') !== false ||
                strpos($formatted_text, ',') !== false ||
                substr($formatted_text, 0) === ' ' || // starts with
                substr($formatted_text, -1) === ' ' || // ends with
                strpos($formatted_text, "\r") !== false ||
                strpos($formatted_text, "\n") !== false
            )
            {
                $formatted_text = "\"{$formatted_text}\"";
            }
        }
        $this->cells[] = $formatted_text;
    }
}