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

/**
 * Class Output
 *
 * @package FastD\Console\Output
 */
class Output implements OutputInterface
{
    protected $style;

    public function __construct(StyleInterface $style = null)
    {
        if (null === $style) {
            $style = new CliStyle();
        }

        $this->style = $style;
    }

    public function write($content, StyleInterface $style = null)
    {
        echo $this->style->format($content);
    }

    public function writeln($content, StyleInterface $style = null)
    {
        echo $this->style->format($content) . PHP_EOL;
    }
}
