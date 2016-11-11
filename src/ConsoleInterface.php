<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Command\Command;
use FastD\Console\Input\ArgvInput;
use FastD\Console\Input\InputArgument;
use FastD\Console\Input\InputOption;

/**
 * Interface ConsoleInterface
 * 
 * @package FastD\Console
 */
interface ConsoleInterface
{
    /**
     * @param ArgvInput $input
     * @return mixed
     */
    public function run(ArgvInput $input);

    /**
     * @return Command[]
     */
    public function getDefaultCommands();

    /**
     * @return InputOption[]
     */
    public function getDefaultInputOptions();

    /**
     * @return InputArgument[]
     */
    public function getDefaultInputArguments();

    /**
     * Get console default command name if cannot enter command.
     * 
     * @return string
     */
    public function getDefaultCommandName();
}