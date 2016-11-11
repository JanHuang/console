<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Command;

use FastD\Console\Collections;
use FastD\Console\Help\Help;
use FastD\Console\Input\Input;
use FastD\Console\Input\InputArgument;
use FastD\Console\Input\InputOption;
use FastD\Console\Output\Output;

/**
 * Class Command
 *
 * @package FastD\Console\Command
 */
abstract class Command
{
    /**
     * @var InputOption[]
     */
    protected $options = [];

    /**
     * @var InputArgument[]
     */
    protected $arguments = [];

    /**
     * @var Collections
     */
    protected $collections;

    /**
     * @return Collections
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * @param Collections $collections
     * @return $this
     */
    public function setCollections(Collections $collections)
    {
        $this->collections = $collections;
        return $this;
    }

    /**
     * @param $name
     * @param null $shortcut
     * @param int $optional
     * @param string $description
     * @param null $default
     * @return $this
     */
    public function setOption($name, $shortcut = null, $optional = InputOption::VALUE_OPTIONAL, $description = '', $default = null)
    {
        $option = new InputOption($name, $shortcut, $optional, $description, $default);

        $this->options[$option->getName()] = $option;

        unset($option);

        return $this;
    }

    /**
     * @param $name
     * @return InputOption
     * @throws \ErrorException
     */
    public function getOption($name)
    {
        if (!array_key_exists($name, $this->options)) {
            throw new \InvalidArgumentException(sprintf('Options "%s" is undefined.', $name));
        }

        return $this->options[$name];
    }

    /**
     * @return InputOption[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $name
     * @param $optional
     * @param string $description
     * @param null $default
     * @return $this
     */
    public function setArgument($name, $optional = InputArgument::OPTIONAL, $description = '', $default = null)
    {
        $argument = new InputArgument($name, $optional, $description, $default);

        $this->arguments[$argument->getName()] = $argument;

        unset($argument);

        return $this;
    }

    /**
     * @param $name
     * @return InputArgument
     * @throws \ErrorException
     */
    public function getArgument($name)
    {
        if (!isset($this->arguments[$name])) {
            throw new \InvalidArgumentException(sprintf('Argument %s is undefined.', $name));
        }

        return $this->arguments[$name];
    }

    /**
     * @return InputArgument[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return string
     */
    abstract public function getDescription();

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return void
     */
    abstract public function configure();

    /**
     * @param Input  $input
     * @param Output $output
     * @return int
     */
    abstract public function execute(Input $input, Output $output);
}