<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/9
 * Time: 下午7:44
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
 * Class Command
 *
 * @package Dobee\Console\Commands
 */
abstract class Command
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var string
     */
    protected $description;

    /**
     * @const string
     */
    const ARG_REQUIRED = ':';

    /**
     * @const string
     */
    const ARG_OPTIONAL = '::';

    /**
     * @const string
     */
    const ARG_NOT = '';

    /**
     * @var array
     */
    protected $arguments = array();

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return void|$this
     */
    abstract public function configure();

    /**
     * @param Input  $input
     * @param Output $output
     * @return void
     */
    abstract public function execute(Input $input, Output $output);

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
     * @param        $name
     * @param        $value
     * @param string $optional
     * @param string $description
     */
    public function setArguments($name, $value, $optional = self::ARG_OPTIONAL, $description = '')
    {
        $this->arguments[$name] = Argument::createArgument($name, $value, $optional, $description);
    }

    /**
     * @param null $name
     * @return Argument|Argument[]
     */
    public function getArguments($name = null)
    {
        if (null === $name) {
            return $this->arguments;
        }

        return $this->arguments[$name];
    }

    /**
     * @param        $name
     * @param        $value
     * @param string $optional
     * @param string $description
     * @return $this
     */
    public function setOptions($name, $value, $optional = self::ARG_OPTIONAL, $description = '')
    {
        $this->options[$name] = Option::createOption($name, $value, $optional, $description);

        return $this;
    }

    /**
     * @param null $name
     * @return Option|Option[]
     */
    public function getOptions($name = null)
    {
        if (null === $name) {
            return $this->options;
        }

        return $this->options[$name];
    }

    /**
     * @return string
     */
    public function getPath()
    {
        if (null === $this->path) {
            $this->path = dirname((new \ReflectionClass($this))->getFileName());
        }

        return $this->path;
    }
}