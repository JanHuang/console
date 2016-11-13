<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Output;

use FastD\Console\Style\StyleInterface;

/**
 * Interface OutputInterface
 *
 * @package FastD\Console\Output
 */
interface OutputInterface
{
    /**
     * @param $content
     * @param StyleInterface|null $style
     * @return mixed
     */
    public function write($content, StyleInterface $style = null);

    /**
     * @param $content
     * @param StyleInterface|null $style
     * @return mixed
     */
    public function writeln($content, StyleInterface $style = null);
}