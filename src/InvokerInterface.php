<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Output\ConsoleOutput;
use FastD\Console\Input\ArgvInput;

/**
 * Interface InvokerInterface
 * 
 * @package FastD\Console
 */
interface InvokerInterface
{
    /**
     * @param ArgvInput $input
     * @param ConsoleOutput $output
     * @return int
     */
    public function execute(ArgvInput $input, ConsoleOutput $output);
}