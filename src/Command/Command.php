<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Command;

use FastD\Console\Input\InputArgument;
use FastD\Console\Input\InputOption;

/**
 * Class Command
 *
 * @package FastD\Console
 */
abstract class Command implements CommandInterface
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
     * @var string
     */
    protected $description;

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
     * @return InputOption|false
     */
    public function getOption($name)
    {
        return array_key_exists($name, $this->options) ? $this->options[$name] : false;
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
     * @return InputArgument|false
     */
    public function getArgument($name)
    {
        return isset($this->arguments[$name]) ? $this->arguments[$name] : false;
    }

    /**
     * @return InputArgument[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}