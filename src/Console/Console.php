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

namespace FastD\Console;

use FastD\Console\Command\Command;
use FastD\Console\Input\ArgvInput;
use FastD\Console\Input\Input;
use FastD\Console\Output\Output;
use RuntimeException;
use Iterator;

/**
 * Class Console
 *
 * @package FastD\Console
 */
class Console implements ConsoleInterface, InvokerInterface, Iterator
{
    /**
     * @var Command[]
     */
    protected $commands = [];

    /**
     * @var Command
     */
    protected $command;

    /**
     * @var Output
     */
    protected $output;

    /**
     * Console constructor.
     */
    public function __construct()
    {
        $this->output = new Output();
    }

    /**
     * @param $name
     * @return Command
     */
    public function getCommand($name)
    {
        if (null === $name || !$this->hasCommand($name)) {
            throw new RuntimeException(sprintf('Command "%s" is not exists.', $name));
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
     * @param ArgvInput $input
     * @return int
     */
    public function run(ArgvInput $input)
    {
        $name = $input->getCommand();

        if (null === $name) {
            $this->output->writeln('<info>Enter your command name:</info>');
            return 0;
        }

        try {
            $this->command = $this->getCommand($name);
        } catch (RuntimeException $e) {
            $this->output->writeln(sprintf('Do you has mean ["<warning>%s</warning>"]?', $name));
            return 0;
        }

        $this->command->configure();

        $input->recombination($this->command);

        return $this->execute($input, $this->output);
    }

    /**
     * @param Input $input
     * @param Output $output
     * @return int
     */
    public function execute(Input $input, Output $output)
    {
        return $this->command->execute($input, $output);
    }

    /**
     * Return the current element
     *
     * @link  http://php.net/manual/en/iterator.current.php
     * @return Command
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->commands);
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
     * @return string
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