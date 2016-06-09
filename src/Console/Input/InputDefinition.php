<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 下午5:12
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Input;

/**
 * Class InputDefinition
 *
 * @package FastD\Console\Input
 */
class InputDefinition
{
    /**
     * @var InputOption[]
     */
    protected $options = [];

    /**
     * Shortcuts. Long option map.
     *
     * @var array
     */
    protected $shortcuts = [];

    /**
     * @var InputArgument[]
     */
    protected $arguments = [];

    /**
     * InputDefinition constructor.
     */
    public function __construct()
    {
        $this->resetInputOptions();
        $this->resetInputArguments();
    }

    /**
     * @param InputOption $option
     * @return $this
     */
    public function setOption(InputOption $option)
    {
        $this->options[$option->getName()] = $option;

        if (null !== $shortcut = $option->getShortcut()) {
            $shortcuts = explode('|', $shortcut);
            foreach ($shortcuts as $shortcut) {
                $this->shortcuts[$shortcut] = $option->getName();
            }
        }

        return $this;
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
     * @param $name
     * @return InputOption|null
     */
    public function getOption($name)
    {
        return $this->hasOption($name) ? $this->options[$name] : null;
    }

    /**
     * @param InputArgument $argument
     * @return $this
     */
    public function setArgument(InputArgument $argument)
    {
        $this->arguments[$argument->getName()] = $argument;

        return $this;
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
     * @return bool
     */
    public function hasArgument($name)
    {
        return isset($this->arguments[$name]);
    }

    /**
     * @param $name
     * @return InputArgument|null
     */
    public function getArgument($name)
    {
        return $this->hasArgument($name) ? $this->arguments[$name] : null;
    }

    /**
     * @return InputOption[]
     */
    public function getDefaultInputOptions()
    {
        return [
            new InputOption('debug', '-d', InputOption::VALUE_NONE, 'Console debug.'),
            new InputOption('help', '-h', InputOption::VALUE_NONE, 'Console or argument help information.'),
        ];
    }

    /**
     * @return array
     */
    public function getDefaultInputArguments()
    {
        return [
            new InputArgument('command', InputArgument::REQUIRED, 'Console execute command name.'),
        ];
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