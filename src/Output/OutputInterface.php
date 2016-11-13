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

interface OutputInterface
{
    public function write($content, StyleInterface $style = null);

    public function writeln($content, StyleInterface $style = null);
}