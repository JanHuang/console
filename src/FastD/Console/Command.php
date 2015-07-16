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

namespace FastD\Console;

use FastD\Console\Environment\EnvironmentInterface;
use FastD\Console\IO\Input;
use FastD\Console\IO\Output;

/**
 * Class Command
 *
 * @package FastD\Console
 */
abstract class Command
{
    const OPT_REQUIRED = 1;
    const OPT_OPTIONAL = 2;
    const OPT_NULL = 3;

    protected $description = '';

    protected $options = [];

    protected $arguments = [];

    protected $help = '';

    /**
     * @var EnvironmentInterface
     */
    protected $env;

    /**
     * @param EnvironmentInterface $interface
     * @return $this
     */
    public function setEnv(EnvironmentInterface $interface)
    {
        $this->env = $interface;

        return $this;
    }

    /**
     * @return EnvironmentInterface
     */
    public function getEnv()
    {
        return $this->env;
    }

    public function setOption($name, $optional = Command::OPT_OPTIONAL, $description = null)
    {
        $this->options[$name] = [
            'optional' => $optional,
            'description' => $description
        ];

        return $this;
    }

    public function getAllOptions()
    {
        return $this->options;
    }

    public function getAllArgument()
    {
        return $this->arguments;
    }

    public function getOption($name)
    {
        if (!isset($this->options[$name])) {
            throw new \ErrorException(sprintf('Options %s is undefined.', $name));
        }

        return $this->options[$name];
    }

    public function setArgument($name, $optional = Command::OPT_OPTIONAL, $description = null)
    {
        $this->arguments[$name] = [
            'optional' => $optional,
            'description' => $description,
        ];

        return $this;
    }

    public function getArgument($name)
    {
        if (!isset($this->arguments[$name])) {
            throw new \ErrorException(sprintf('Argument %s is undefined.', $name));
        }

        return $this->arguments[$name];
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setHelp($help)
    {
        $this->help = $help;

        return $this;
    }

    public function getHelp()
    {
        return $this->help;
    }

    abstract public function getName();

    abstract public function configure();

    abstract public function execute(Input $input, Output $output);

    public function __toString()
    {
        return sprintf("Command '%s': --help %s %s\n", $this->getName(), '', '');
    }
}