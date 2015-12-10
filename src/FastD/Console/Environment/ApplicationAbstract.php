<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/11
 * Time: 上午1:01
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Environment;

use FastD\Console\ArgvInput;
use FastD\Console\Command\Command;

abstract class ApplicationAbstract implements ApplicationInterface
{
    /**
     * @var array
     */
    protected $commands = [];

    /**
     * @param $name
     * @return Command
     */
    public function getCommand($name)
    {
        if (null === $name || !$this->hasCommand($name)) {
            throw new \RuntimeException(sprintf('Command "%s" is not exists.', $name));
        }

        return $this->commands[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasCommand($name)
    {
        return isset($this->commands[$name]) ? $this->commands[$name] : null;
    }

    /**
     * @param Command $command
     * @return $this
     */
    public function setCommand(Command $command)
    {
        $this->commands[$command->getName()] = $command;

        return $this;
    }

    /**
     * @param ArgvInput $argvInput
     * @return int
     */
    public function run(ArgvInput $argvInput)
    {
        $this->getCommand($argvInput->getCommandName());
    }
}