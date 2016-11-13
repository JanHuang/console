<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Input\InputInterface;
use FastD\Console\Output\OutputInterface;

interface CommandInterface
{
    public function execute(InputInterface $input, OutputInterface $output);
}