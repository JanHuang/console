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

use FastD\Console\Input\Input;
use FastD\Console\Output\Output;

/**
 * Class Command
 *
 * @package FastD\Console\Command
 */
abstract class Command
{
    /**
     * @var ApplicationInterface
     */
    protected $application;

    /**
     * @var string
     */
    protected $help = [];

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * @return ApplicationInterface
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param ApplicationInterface $applicationInterface
     * @return $this
     */
    public function setApplication(ApplicationInterface $applicationInterface)
    {
        $this->application = $applicationInterface;

        return $this;
    }

    /**
     * @param        $name
     * @param string $optional
     * @param null   $help
     * @return $this
     */
    public function setOption($name, $optional = Input::ARG_OPTIONAL, $help = null)
    {
        $this->options[$name] = $optional;

        $this->help[$name] = $help;

        return $this;
    }

    /**
     * @param $name
     * @return mixed
     * @throws \ErrorException
     */
    public function getOption($name = null)
    {
        if (null === $name) {
            return $this->options;
        }

        if (array_key_exists($name, $this->options)) {
            throw new \ErrorException(sprintf('Options %s is undefined.', $name));
        }

        return $this->options[$name];
    }

    /**
     * @param        $name
     * @param string $optional
     * @param null   $help
     * @return $this
     */
    public function setArgument($name, $optional = Input::ARG_OPTIONAL, $help = null)
    {
        $this->arguments[$name] = $optional;

        $this->help[$name] = $help;

        return $this;
    }

    /**
     * @param $name
     * @return mixed
     * @throws \ErrorException
     */
    public function getArgument($name = null)
    {
        if (null === $name) {
            return $this->arguments;
        }

        if (!isset($this->arguments[$name])) {
            throw new \ErrorException(sprintf('Argument %s is undefined.', $name));
        }

        return $this->arguments[$name];
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

    /**
     * @param $help
     * @return $this
     */
    public function setHelp($help)
    {
        $this->help = $help;

        return $this;
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        return $this->help;
    }

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

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("Command '%s': --help %s %s\n", $this->getName(), '', '');
    }
}