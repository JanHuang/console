<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Output;

/**
 * Class Output
 *
 * @package FastD\Console\Output
 */
class Output implements OutputInterface
{
    public function __construct(StyleInterface $style = null)
    {
        if (null === $style) {
        }
    }

    public function write($content, $frontendColor, $backendColor)
    {
        echo $content;
    }

    public function writeln($content, $frontendColor, $backendColor)
    {
        echo $content . PHP_EOL;
    }
}
