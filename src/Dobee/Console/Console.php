<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/9
 * Time: 下午7:38
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console;

use Dobee\Console\Commands\Command;
use Dobee\Console\Commands\CommandCollections;
use Dobee\Console\Format\Input;
use Dobee\Console\Format\Output;

/**
 * Class Console
 *
 * @package Dobee\Console
 */
class Console
{
    /**
     * @var CommandCollections
     */
    private $collections;

    /**
     * @var Input
     */
    private $input;

    /**
     * @var Output
     */
    private $output;

    /**
     * @param array $predefined
     */
    public function __construct(array $predefined = array())
    {
        $this->collections = new CommandCollections();

        $this->input = new Input();

        $this->output = new Output();

        if (!empty($predefined) && is_array($predefined)) {
            foreach ($predefined as $command) {
                if (!class_exists($command)) {
                    continue;
                }

                $command = new $command();

                if (!($command instanceof Command)) {
                    throw new \InvalidArgumentException(sprintf('The command must be extend to "Dobee\Console\Commands\Command"'));
                }

                $this->addCommand($command);
            }
        }
    }

    /**
     * @param Command $command
     * @return $this
     */
    public function addCommand(Command $command)
    {
        $this->collections->setCommand($command);

        return $this;
    }

    /**
     * @return int
     */
    public function run()
    {
        $commandName = $this->input->getCommandName();

        try {
            $command = $this->collections->getCommand($commandName);
        } catch (\Exception $e) {
            $this->output->writeln(sprintf('Not found you command: "%s"', $commandName));
            return 1;
        }

        $command->configure();

        $this->output->writeln($command->getDescription()?:$command->getName());

        // Merge console input arguments and check required arguments.
        $i = 0;
        foreach ($command->getArguments() as $name => $argument) {
            $value = isset($this->input->getArguments()[$i]) ? $this->input->getArguments()[$i] : null;
            if ($argument->getOptional() === Command::ARG_REQUIRED && null === $value) {
                $value = $this->input->systemInput(sprintf("Please input argument value [%s]: ", $name));
            }
            if ($argument->getOptional() === Command::ARG_NOT) {
                continue;
            }
            $command->getArguments($name)->setValue($value);
            ++$i;
        }

        unset($i);

        // Merge console input options and check required options.
        foreach ($command->getOptions() as $name => $option) {
            $value = isset($this->input->getOptions()[$name]) ? $this->input->getOptions()[$name] : null;
            if ($option->getOptional() === Command::ARG_REQUIRED && null === $value) {
                $value = $this->input->systemInput(sprintf("Please input optional value [%s]: ", $name));
            }
            if ($option->getOptional() === Command::ARG_NOT) {
                continue;
            }
            $command->getOptions($name)->setValue($value);
        }

        $command->execute($this->input, $this->output);

        return 0;
    }
}