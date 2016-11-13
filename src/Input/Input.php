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
use FastD\Console\Command;

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
     * @param InputDefinitionInterface|null $inputDefinition
     */
    public function __construct(array $argv = null, InputDefinitionInterface $inputDefinition = null)
    {
        $this->argv = null === $argv ? $_SERVER['argv'] : $argv;
        // remove script file
        array_shift($this->argv);

        if (null !== $inputDefinition) {
            $this->bind($inputDefinition);
        } else {
            $this->definition = new InputDefinition();
        }
    }

    /**
     * @param InputDefinitionInterface $inputDefinition
     * @return $this
     */
    public function bind(InputDefinitionInterface $inputDefinition)
    {
        $this->definition = $inputDefinition;

        $this->parse();

        return $this;
    }

    /**
     * @param Command $command
     * @return $this
     */
    public function bindCommand(Command $command)
    {
        $this->definition->bindCommand($command);

        $this->bind($this->definition);

        return $this;
    }

    /**
     * @return array
     */
    protected function formatInputArguments()
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
    public function parse()
    {
        $args = $this->formatInputArguments();

        foreach ($args as $key => $value) {
            if ('--' === substr($value, 0, 2)) {
                $this->parseOption(substr($value, 2));
            } else if ('-' === substr($value, 0, 1)) {
                $this->parseOption(substr($value, 1));
            } else {
                $this->parseArgument($value);
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
            if ('true' == $argument) {
                $argument = true;
            }
            if ('false' == $argument) {
                $argument = true;
            }
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
            if ('true' == $value) {
                $value = true;
            }
            if (false == $value) {
                $value = false;
            }
        }

        if ($this->definition->hasOption($key) && $this->definition->getOption($key)->isNone()) {
            $value = null;
        }

        $this->options[$key] = $value;

        unset($option, $key, $value);

        return $this;
    }

    /**
     * get first argument
     *
     * @return string|null
     */
    public function getFirstArgument()
    {
        foreach ($this->argv as $value) {
            if ($value && '-' === $value[0]) {
                continue;
            }

            return $value;
        }

        return isset($this->definition->getDefaultInputArguments()[0]) ?
            $this->definition->getDefaultInputArguments()[0]->getDefault() : false;
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
        if ($this->hasArgument($name)) {
            return $this->arguments[$name];
        }

        if (($argument = $this->definition->getArgument($name)) instanceof InputArgument) {
            return $argument->getDefault();
        }

        return false;
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
            if (array_key_exists($item, $this->options)) {
                return $this->options[$item];
            }
        }

        foreach ($name as $item) {
            if (($option = $this->definition->getOption($item)) instanceof InputOption) {
                $key = $option->getName() == $item ? $option->getShortcut() : $option->getName();
                return isset($this->options[$key]) ? $this->options[$key] : $option->getDefault();
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