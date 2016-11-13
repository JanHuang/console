<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Input;

use FastD\Console\Command\CommandInterface;

/**
 * Class InputDefinition
 *
 * @package FastD\Console\Input
 */
class InputDefinition implements InputDefinitionInterface
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
     * Shortcuts. Long option map.
     *
     * @var array
     */
    protected $shortcuts = [];

    /**
     * @var array
     */
    protected $required = [];

    /**
     * InputDefinition constructor.
     */
    public function __construct()
    {
        $this->resetInputOptions();
        $this->resetInputArguments();
    }

    /**
     * @param CommandInterface $command
     * @return $this
     */
    public function bindCommand(CommandInterface $command)
    {
        $command->configure();
        $this->mergeInputArguments($command->getArguments());
        $this->mergeInputOptions($command->getOptions());
        return $this;
    }

    /**
     * @param InputOption $option
     * @return $this
     */
    public function setOption(InputOption $option)
    {
        $this->options[$option->getName()] = $option;

        if ($option->isRequired() && null === $option->getDefault()) {
            $this->required[$option->getName()] = $option;
        }

        if (!empty($shortcut = $option->getShortcut())) {
            $shortcuts = explode('|', $shortcut);
            foreach ($shortcuts as $shortcut) {
                $this->shortcuts[$shortcut] = $option->getName();
            }
        }

        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasOption($name)
    {
        if (isset($this->shortcuts[$name])) {
            $name = $this->shortcuts[$name];
        }

        return isset($this->options[$name]);
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
     * @return InputOption|false
     */
    public function getOption($name)
    {
        if (isset($this->shortcuts[$name])) {
            $name = $this->shortcuts[$name];
        }

        return $this->hasOption($name) ? $this->options[$name] : false;
    }

    /**
     * @param InputArgument $argument
     * @return $this
     */
    public function setArgument(InputArgument $argument)
    {
        $this->arguments[$argument->getName()] = $argument;

        if ($argument->isRequired() && null === $argument->getDefault()) {
            $this->required[$argument->getName()] = $argument;
        }

        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasArgument($name)
    {
        return isset($this->arguments[$name]);
    }

    /**
     * @return InputArgument[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param $name
     * @return InputArgument|bool
     */
    public function getArgument($name)
    {
        return $this->hasArgument($name) ? $this->arguments[$name] : false;
    }

    /**
     * @return InputOption[]
     */
    public function getDefaultInputOptions()
    {
        return [
            new InputOption('--debug', '-v|-vv|-vvv', InputOption::VALUE_NONE, 'debug'),
            new InputOption('--help', '-h', InputOption::VALUE_NONE, 'help information'),
            new InputOption('--env', '-e', InputOption::VALUE_OPTIONAL, 'runtime environment', 'dev'),
        ];
    }

    /**
     * @return InputArgument[]
     */
    public function getDefaultInputArguments()
    {
        return [
        ];
    }

    /**
     * @return array
     */
    public function getRequires()
    {
        return $this->required;
    }

    /**
     * Reset definition option.
     */
    public function resetInputOptions()
    {
        $this->mergeInputOptions($this->getDefaultInputOptions());
    }

    /**
     * Reset definition argument.
     */
    public function resetInputArguments()
    {
        $this->mergeInputArguments($this->getDefaultInputArguments());
    }

    /**
     * @param array $options
     */
    public function mergeInputOptions(array $options)
    {
        foreach ($options as $option) {
            $this->setOption($option);
        }
    }

    /**
     * @param array $arguments
     */
    public function mergeInputArguments(array $arguments)
    {
        foreach ($arguments as $argument) {
            $this->setArgument($argument);
        }
    }
}