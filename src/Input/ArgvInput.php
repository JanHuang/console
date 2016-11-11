<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Input;

use FastD\Console\Command\Command;

/**
 * Class ArgvInput
 *
 * @package FastD\Console\Input
 */
class ArgvInput extends Input
{
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
        $this->bind($inputDefinition);

        parent::__construct($argv);
    }

    /**
     * @param InputDefinition $definition
     * @return void
     */
    public function bind(InputDefinition $definition = null)
    {
        if (null === $definition) {
            $definition = new InputDefinition();
        }

        $this->definition = $definition;
    }

    /**
     * @param Command $command
     * @return array
     */
    public function bindCommand(Command $command)
    {
        $definition = $this->definition;

        foreach ($command->getArguments() as $argument) {
            $definition->setArgument($argument);
        }

        foreach ($command->getOptions() as $option) {
            $definition->setOption($option);
        }

        return $this->validationArguments($definition);
    }

    /**
     * @param InputDefinition $definition
     * @return array
     */
    protected function validationArguments(InputDefinition $definition)
    {
        $missing = [];

        foreach ($definition->getRequiredInputArgumentsAndOptions() as $argumentsAndOption) {
            if ($argumentsAndOption instanceof InputOption) {
                if (!array_key_exists($argumentsAndOption->getName(), $this->options)) {
                    $missing[] = $argumentsAndOption;
                }
            } else if ($argumentsAndOption instanceof InputArgument) {
                if (!array_key_exists($argumentsAndOption->getName(), $this->arguments)) {
                    $missing[] = $argumentsAndOption;
                }
            }
        }
        
        return $missing;
    }

    /**
     * @return void
     */
    public function resetCommand()
    {
        foreach ($this->getArguments() as $key => $argument) {
            if (is_string($key)) {
                unset($this->arguments[$key]);
            }
        }
    }
}