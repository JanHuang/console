<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Input;

use ArrayIterator;

/**
 * Class Input
 *
 * @package FastD\Console\Input
 */
class Input implements InputInterface
{
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
     * @var InputDefinition
     */
    protected $definition;

    /**
     * Input constructor.
     *
     * @param array|null $argv
     * @param InputDefinition|null $inputDefinition
     */
    public function __construct(array $argv = null, InputDefinition $inputDefinition = null)
    {
        $this->argv = null === $argv ? $_SERVER['argv'] : $argv;
        // remove script file
        array_shift($this->argv);

        if (null === $inputDefinition) {
            $inputDefinition = new InputDefinition();
        }

        $this->definition = $inputDefinition;

        $this->parse();
    }

    /**
     * @return array
     */
    public function formatInputArguments()
    {
        $args = [];
        // filter input arguments
        $iterator = new ArrayIterator($this->argv);
        while ($iterator->valid()) {
            $value = $iterator->current();
            if (false === strpos($value, '=') && false !== strpos($value, '-')) {
                $iterator->next();
                $next = $iterator->current();
                if (!empty($next)) {
                    if (false === strpos($next, '-')) {
                        $args[] = $value . '=' . $next;
                    } else {
                        $args[] = $value;
                        $args[] = $next;
                    }
                } else {
                    $args[] = $value;
                }
            } else {
                $args[] = $value;
            }
            $iterator->next();
        }

        unset($iterator);

        return $args;
    }

    /**
     * Parse CLI input arguments.
     *
     * @return void
     */
    protected function parse()
    {
        $args = $this->formatInputArguments();

        foreach ($args as $value) {
            if ('--' === substr($value, 0, 2)) {
                $this->parseOption(substr($value, 2));
            } else if ('-' === substr($value, 0, 1)) {
                $this->parseOption(substr($value, 1));
            } else {
                $this->parseArgument($value);
            }
        }

        if (empty($this->arguments)) {
            foreach ($this->definition->getDefaultInputArguments() as $inputArgument) {
                $this->arguments[$inputArgument->getName()] = $inputArgument->getDefault();
            }
        }
    }

    /**
     * @param $argument
     * @return $this
     */
    protected function parseArgument($argument)
    {
        $keys = array_keys($this->definition->getArguments());
        $this->arguments[] = $argument;
        $offset = count($this->arguments) - 1;

        $name = isset($keys[$offset]) ? $keys[$offset] : null;
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
    protected function parseOption($option)
    {
        if (false === strpos($option, '=')) {
            $key = $option;
            $value = null;
        } else {
            list($key, $value) = explode('=', $option);
            $value = trim($value, '\'"');
        }

        if ($this->definition->hasOption($key) && $this->definition->getOption($key)->isNone()) {
            $value = null;
        }

        $this->options[$key] = $value;

        unset($option, $key, $value);

        return $this;
    }

    /**
     * Execute command name.
     *
     * @return string|null
     */
    public function getFirstArgument()
    {
        return reset($this->arguments);
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getArgument($name)
    {
        return $this->hasArgument($name) ? $this->arguments[$name] : false;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasArgument($name)
    {
        return array_key_exists($name, $this->arguments);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getOption($name)
    {
        if (is_string($name)) {
            $name = [$name];
        }

        foreach ($name as $item) {
            if (isset($this->options[$item])) {
                return $this->options[$item];
            } else if ($this->definition->hasOption($item)) {
                return $this->definition->getOption($item)->getDefault();
            }
        }

        return false;
    }

    /**
     * @param $name
     * @return bool|null
     */
    public function hasOption($name)
    {
        if (is_string($name)) {
            $name = [$name];
        }

        foreach ($name as $value) {
            if (array_key_exists($value, $this->options)) {
                return true;
            }
        }

        return false;
    }
}