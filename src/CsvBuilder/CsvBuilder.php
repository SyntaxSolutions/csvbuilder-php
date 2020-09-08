<?php
namespace SyntaxSolutions\CsvBuilder;

class CsvBuilder
{
    private $headerBuilder;
    private $contentBuilder;
    private $delimiter = ",";
    private $linebreak = PHP_EOL;

    /**
     * CsvBuilder constructor.
     * @param array $options
     */
    public function __construct()
    {
        // add a Byte Order Marker to the data stream to ensure Excel opens the CSV file with UTF8 encoding.
        $BOM = "\xEF\xBB\xBF"; // UTF-8 Byte Order Marker
        $this->headerBuilder = $BOM;
        $this->contentBuilder = "";
    }

    /**
     * Add a CSVRow used for the column headers values
     * @param CsvRow|null $row
     */
    public function addHeaders(CsvRow $row = null)
    {
        if ($row != null)
        {
            if (count($row->cells) > 0)
            {
                // flush any previously added cells
                $line = join($this->delimiter, $row->cells);
                $this->headerBuilder .= $line;
            }
            $this->headerBuilder .= $this->linebreak;
        }
    }

    /**
     * Add CSVRow
     * @param CsvRow|null $row
     */
    public function addRow(CsvRow $row = null)
    {
        if ($row != null)
        {
            if (count($row->cells) > 0)
            {
                // flush any previously added cells
                $line = join($this->delimiter, $row->cells);
                $this->contentBuilder .= $line;
            }
        }

        $this->contentBuilder .= $this->linebreak;
    }

    /**
     * Return the contents of the CSV as a UTF8 encoded array of bytes
     * @return string
     */
    public function getBytes()
    {
        // Note: UTF-8 is normally the default internal encoding. Check php.ini settings
        $content = $this->headerBuilder . $this->contentBuilder;
        return $content;
    }
}