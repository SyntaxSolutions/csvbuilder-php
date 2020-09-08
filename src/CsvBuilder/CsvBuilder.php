<?php
namespace SyntaxSolutions\CsvBuilder;

class CsvBuilder
{
    private $headerBuilder;
    private $contentBuilder;
    private $delimiter = ",";
    private $linebreak = PHP_EOL;
    private $BOM = "\xEF\xBB\xBF"; // UTF-8 Byte Order Marker

    /**
     * Create a new CsvBuilder
     */
    public function __construct()
    {
        $this->headerBuilder = '';
        $this->contentBuilder = '';
    }

    /**
     * Add a CsvRow used for the column headers values
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
     * Add CsvRow
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
        $content = null;
        if (strlen($this->headerBuilder) || strlen($this->contentBuilder))
        {
            // add a Byte Order Marker to the data stream to ensure Excel opens the CSV file with UTF8 encoding.
            // Note: UTF-8 is normally the default internal encoding. Check php.ini settings
            $content = $this->BOM . $this->headerBuilder . $this->contentBuilder;
        }

        return $content;
    }
}