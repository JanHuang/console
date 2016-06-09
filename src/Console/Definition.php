<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午11:29
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console;

use FastD\Console\Command\HelpCommand;
use FastD\Console\Command\ListCommand;
use FastD\Console\Command\Command;

/**
 * trait Definition
 *
 * @package FastD\Console
 */
trait Definition
{
    /**
     * @return Command[]
     */
    public function getDefaultCommands()
    {
        return [
            new HelpCommand(),
            new ListCommand(),
        ];
    }
}