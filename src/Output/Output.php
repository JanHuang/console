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
    public function write($content, StyleInterface $style = null)
    {
        if (null !== $style) {
            echo $style->format($content);
        } else {
            echo $this->style->format($content);
        }
    }

    /**
     * @param $content
     * @param StyleInterface|null $style
     * @return mixed
     */
    public function writeln($content, StyleInterface $style = null)
    {
        $this->write($content, $style);

        echo PHP_EOL;
    }
}
