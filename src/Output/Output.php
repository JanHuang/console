<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Output;

use FastD\Console\Style\CliStyle;
use FastD\Console\Style\StyleInterface;
use FastD\Console\Style\TableStyle;

/**
 * Class Output
 *
 * @package FastD\Console\Output
 */
class Output implements OutputInterface
{
    /**
     * @var StyleInterface
     */
    protected $style;

    /**
     * Output constructor.
     *
     * @param StyleInterface $style
     */
    public function __construct(StyleInterface $style = null)
    {
        if (null === $style) {
            $style = new CliStyle();
        }

        $this->style = $style;
    }

    /**
     * @param $content
     * @param StyleInterface|null $style
     * @return mixed
     */
    public function format($content, StyleInterface $style = null)
    {
        if (null !== $style) {
            $content = $style->format($content);
        } else {
            $content = $this->style->format($content);
        }

        return $content;
    }

    /**
     * @param $content
     * @param StyleInterface|null $style
     * @return void
     */
    public function write($content, StyleInterface $style = null)
    {
        echo $this->format($content, $style);
    }

    /**
     * @param $content
     * @param StyleInterface|null $style
     * @return void
     */
    public function writeln($content, StyleInterface $style = null)
    {
        echo ($this->format($content, $style) . PHP_EOL);
    }

    /**
     * @param array $header
     * @param array $data
     * @return void
     */
    public function table(array $header = [], array $data = [])
    {
        $style = new TableStyle();

        $style->headers($header);

        $this->write($data, $style);
    }
}
