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
use FastD\Console\Console;

/**
 * Class ArgvInput
 * @package FastD\Console\Input
 */
class ArgvInput extends Input
{
    /**
     * @param Console $console
     * @param Command $command
     * @return array
     */
    public function bindCommand(Console $console, Command $command)
    {
        $definition = new InputDefinition();

        if (!empty($console->getDefaultInputArguments())) {
            foreach ($console->getDefaultInputArguments() as $argument) {
                $definition->setArgument($argument);
            }
        }

        foreach ($command->getArguments() as $argument) {
            $definition->setArgument($argument);
        }

        if (!empty($console->getDefaultInputOptions())) {
            foreach ($console->getDefaultInputOptions() as $option) {
                $definition->setOption($option);
            }
        }

        foreach ($command->getOptions() as $option) {
            $definition->setOption($option);
        }

        $this->bind($definition);

        return $this->validationArguments($definition);
    }

    /**
     * @param InputDefinition $definition
     * @return array
     */
    public function validationArguments(InputDefinition $definition)
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
     * @return array
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