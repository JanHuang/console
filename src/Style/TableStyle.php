<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Style;

/**
 * Class TableStyle
 *
 * @package FastD\Console\Style
 */
class TableStyle implements TableStyleInterface, StyleInterface
{
    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var array max length
     */
    private $maxLength = [];

    /**
     * @var int
     */
    private $columns;

    /**
     * @var string
     */
    private $line;

    /**
     * Find maximum lengths for each column
     *
     * @param array $data
     * @return void
     */
    protected function getLengths(array $data)
    {
        for ($i = 0; $i < $this->columns; $i++) {
            $this->maxLength[$i] = 0;
            foreach ($this->headers as $field) {
                if (strlen($field) > $this->maxLength[$i]) {
                    $this->maxLength[$i] = strlen($field);
                }
            }
        }

        foreach ($data as $row) {
            $i = 0;
            foreach ($row as $field) {
                if (strlen($field) > $this->maxLength[$i]) {
                    $this->maxLength[$i] = strlen($field);
                }
                $i++;
            }
        }
    }

    /**
     * @param array $headers
     * @return string
     */
    protected function generateHeader(array $headers)
    {
        $table = '';

        for ($i = 0; $i < $this->columns; $i++) {
            $table .= '+';
            $len = $this->maxLength[$i] + 2;
            $table .= sprintf("%'-{$len}s", '');
        }
        $table .= '+' . PHP_EOL;

        $this->line = $table;

        for ($i = 0; $i < $this->columns; $i++) {
            $len = $this->maxLength[$i] + 1;
            $table .= '| ';
            $table .= sprintf("%' -{$len}s", $headers[$i]);
        }

        $table .= '|' . PHP_EOL;

        $table .= $this->line;

        return $table;
    }

    /**
     * @param array
     * @return string
     */
    private function generateBody(array $data)
    {
        $table = '';

        foreach ($data as $row) {
            $i = 0;
            foreach ($row as $field) {
                $len = $this->maxLength[$i] + 1;
                $table .= '| ' . sprintf("%' -{$len}s", $field);
                $i++;
            }
            $table .= '|' . PHP_EOL;
        }

        $table .= $this->line;

        return $table;
    }

    /**
     * @param $content
     * @return string
     */
    public function format($content)
    {
        if (!is_array($content)) {
            throw new \RuntimeException('Data passed must be an array');
        }

        $this->columns = count($this->headers);

        $this->getLengths($content);

        $table = '';
        $table .= $this->generateHeader($this->headers);
        $table .= $this->generateBody($content);

        return $table;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function headers(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }
}