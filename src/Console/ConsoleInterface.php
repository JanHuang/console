<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/30
 * Time: 上午10:49
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
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