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
     * @const string
     */
    const THANKS = 'Thank you for your use Dobee console Component.';

    /**
     * @var Output
     */
    private $output;

    /**
     * @var array
     */
    private $trace;

    /**
     * @var array
     */
    private $predefined = array(
        'Dobee\\Console\\Dumper\\Dump',
        'Dobee\\Routing\\Commands\\Dump',
        'Dobee\\Routing\\Commands\\Caching',
    );

    /**
     * @param array $predefined
     */
    public function __construct(array $predefined = array())
    {
        $this->collections = new CommandCollections();

        $this->output = new Output();

        $this->input = new Input();

        if (is_array($predefined)) {

            $predefined = array_merge($this->predefined, $predefined);

            foreach ($predefined as $command) {
                if (!class_exists($command)) {
                    continue;
                }

                $command = new $command($this->input, $this->output);

                if (!($command instanceof Command)) {
                    throw new \InvalidArgumentException(sprintf('The command must be extend to "Dobee\Console\Commands\Command"'));
                }

                $command->setCollections($this->collections);

                $this->addCommand($command);
            }
        }

        $this->thankUse();
    }

    public function thankUse()
    {
        $this->output->writeBackground(self::THANKS, Output::STYLE_SUCCESS);
    }

    /**
     * @return Input
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param Input $input
     * @return $this
     */
    public function setInput(Input $input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * @return Output
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param Output $output
     * @return $this
     */
    public function setOutput(Output $output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * @param Command $command
     * @return $this
     */
    public function addCommand(Command $command)
    {
        $this->collections->setCommand($command, $this->input, $this->output);

        return $this;
    }

    /**
     * @return array
     */
    public function getTrace()
    {
        return $this->trace;
    }

    /**
     * @return int
     */
    public function run()
    {
        $commandName = $this->input->getCommandName();

        try {
            $command = $this->collections->getCommand($commandName);
        } catch (\InvalidArgumentException $e) {
            $this->collections->executeCommand('command:dump', $this->input, $this->output);
            return 1;
        }

        $this->trace[] = $commandName;

        $command->setCollections($this->collections);

        $command->configure();

        $this->output->writeBackground($command->getDescription(), Output::STYLE_BG_NOTICE);

        $this->input->setArguments($command->getArguments());
        $this->input->setOptions($command->getOptions());
        $this->input->parseArgumentAndOptions();

        $command->setArguments($this->input->getArguments());
        $command->setOptions($this->input->getOptions());

        $command->execute($this->input, $this->output);

        return 0;
    }
}