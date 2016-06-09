<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/16
 * Time: 下午2:11
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace FastD\Console\Input;

/**
 * Class Input
 *
 * @package FastD\Console\Input
 */
class Input implements InputInterface
{
    /**
     * @var InputDefinition
     */
    protected $definition;

    /**
     * Server argv.
     *
     * @var array
     */
    protected $argv;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * Input constructor.
     *
     * @param array|null $argv
     * @param InputDefinition|null $inputDefinition
     */
    public function __construct(array $argv = null, InputDefinition $inputDefinition = null)
    {
        $this->argv = null === $argv ? $_SERVER['argv'] : $argv;

        array_shift($this->argv);

        if (null !== $inputDefinition) {
            $this->bind($inputDefinition);
        }
    }

    /**
     * @param InputDefinition $definition
     */
    public function bind(InputDefinition $definition)
    {
        $this->resetArguments();
        $this->resetOptions();

        $this->definition = $definition;

        $this->parse($this->argv);
    }

    /**
     * @param array $argv
     * @return void
     */
    protected function parse(array $argv = null)
    {
        if (null === $argv) {
            $argv = $this->argv;
        }

        foreach ($argv as $value) {
            if ('--' === substr($value, 0, 2)) {
                $this->parseLongOptions($value);
            } else if ('-' === substr($value, 0, 1)) {
                $this->parseShortOptions($value);
            } else {
                $this->parseArguments($value);
            }
        }
    }

    /**
     * @param $argument
     * @return $this
     */
    protected function parseArguments($argument)
    {
        $keys = array_keys($this->definition->getArguments());

        $this->arguments[] = $argument;

        $name = $keys[count($this->arguments) - 1];

        array_pop($this->arguments);

        if ($this->definition->hasArgument($name)) {
            $this->arguments[$name] = $argument;
        }

        return $this;
    }

    /**
     * @param $option
     * @return $this
     */
    protected function parseLongOptions($option)
    {
        if (false === ($index = strpos($option, '='))) {
            $key = substr($option, 2);
            $value = null;
        } else {
            list($key, $value) = explode('=', $option);
            $key = substr($key, 2);
            $value = trim($value, "\'\"");
        }

        if ($this->definition->hasOption($key)) {
            $this->options[$key] = $value;
        }

        return $this;
    }

    /**
     * @param $option
     * @return $this
     */
    protected function parseShortOptions($option)
    {
        if (false === ($index = strpos($option, '='))) {
            $key = substr($option, 1);
            $value = null;
        } else {
            list($key, $value) = explode('=', $option);
            $key = substr($key, 1);
            $value = trim($value, "\'\"");
        }

        if ($this->definition->hasOption($key)) {
            $this->options[$key] = $value;
        }

        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getFirstArgument()
    {
        return $this->arguments[0] ?? null;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function getArgument($name)
    {

    }

    public function getOptions()
    {

    }

    public function getOption($name)
    {
        
    }

    /**
     * @param $name
     * @return bool|null
     */
    public function hasOption($name)
    {

    }

    /**
     *
     */
    public function resetOptions()
    {
        $this->options = [];
    }

    /**
     *
     */
    public function resetArguments()
    {
        $this->arguments = [];
    }
}