<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/9
 * Time: 下午7:45
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Commands;

use Dobee\Console\Format\Input;
use Dobee\Console\Format\Output;

/**
 * Class CommandCollections
 *
 * @package Dobee\Console\Commands
 */
class CommandCollections implements \Iterator
{
    /**
     * @var Command[]
     */
    private $collections = array();

    /**
     * @param Command $command
     * @param Input   $input
     * @param Output  $output
     * @return $this
     */
    public function setCommand(Command $command, Input $input = null, Output $output = null)
    {
        $this->collections[$command->getName()] = $command;

        if (!($command->getInput() instanceof Input) && null !== $input) {
            $command->setInput($input);
        }

        if (!($command->getOutput() instanceof Output) && null !== $output) {
            $command->setOutput($output);
        }

        return $this;
    }

    /**
     * @param $name
     * @return Command
     */
    public function getCommand($name)
    {
        if (!isset($this->collections[$name])) {
            throw new \InvalidArgumentException(sprintf('Command "%s" is undefined.', $name));
        }

        return $this->collections[$name];
    }

    /**
     * @return Command[]
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * @param        $name
     * @param Input  $input
     * @param Output $output
     */
    public function executeCommand($name, Input $input, Output $output)
    {
        $command = $this->getCommand($name);

        $command->configure();

        $command->execute($input, $output);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     *
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return current($this->collections);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     *
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        next($this->collections);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     *
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return key($this->collections);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     *
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     *       Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->collections[$this->key()]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     *
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        reset($this->collections);
    }
}