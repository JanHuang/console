<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Input\Input;
use FastD\Console\Output\Output;

interface CommandInterface
{
    public function execute(Input $input, Output $output);
}