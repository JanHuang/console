<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/29
 * Time: 下午11:31
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Command;

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
     * @return Help
     */
    public function getHelp(){}

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