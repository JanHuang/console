<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午11:34
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console;

use FastD\Console\Command\Command;
use Iterator;

abstract class Collections implements Iterator
{
    /**
     * @var Command[]
     */
    protected $commands = [];

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
        $command->setCollections($this);

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
        $find = function ($path) use (&$find) {

        };
    }

    /**
     * Return the current element
     *
     * @link  http://php.net/manual/en/iterator.current.php
     * @return Command Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->commands[$this->key()];
    }

    /**
     * Move forward to next element
     *
     * @link  http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->commands);
    }

    /**
     * Return the key of the current element
     *
     * @link  http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->commands);
    }

    /**
     * Checks if current position is valid
     *
     * @link  http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     *        Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->commands[$this->key()]);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->commands);
    }
}