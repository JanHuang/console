<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Command\CommandInterface;
use FastD\Console\Input\InputDefinitionInterface;

/**
 * Interface ConsoleInterface
 * 
 * @package FastD\Console
 */
interface ConsoleInterface
{
    /**
     * @return mixed
     */
    public function run();

    /**
     * @return CommandInterface[]
     */
    public function getDefaultCommands();

    /**
     * @return InputDefinitionInterface
     */
    public function getDefaultDefinition();
}