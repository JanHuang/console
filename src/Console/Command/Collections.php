<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午10:19
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Command;

use Symfony\Component\Finder\Finder;

/**
 * Class CommandCollections
 *
 * @package FastD\Console\Command
 */
class Collections
{
    /**
     * @var array
     */
    protected $commands = [];

    /**
     * CommandCollections constructor.
     *
     * @param string $path
     * @param array $commands
     */
    public function __construct($path = null, array $commands = [])
    {
        if (null !== $path) {
            $this->setCommandDir($path);
        }

        $this->addCommand(new HelpCommand());
        $this->addCommand(new ListCommand());

        $this->setCommand($commands);
    }

    /**
     * @param array $commands
     * @return $this
     */
    public function setCommand(array $commands = [])
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }

        return $this;
    }

    /**
     * @param Command $command
     * @return $this
     */
    public function addCommand(Command $command)
    {
        $this->commands[$command->getName()] = $command;

        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasCommand($name)
    {
        return isset($this->commands[$name]);
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getCommand($name)
    {
        return $this->hasCommand($name) ? $this->commands[$name] : null;
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param $path
     * @param bool $recursive
     * @return $this
     */
    public function setCommandDir($path, $recursive = true)
    {
        $find = new Finder();
    }
}