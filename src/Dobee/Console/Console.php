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
use Dobee\Console\Dumper\Dump;
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

    private $provider;

    public function __construct()
    {
        $this->collections = new CommandCollections();

        $this->output = new Output();

        $this->input = new Input();

        $this->initConsoleCommand();

        $this->thankUse();
    }

    private function initConsoleCommand()
    {
        $dumper = new Dump();

        $dumper->setCollections($this->collections);

        $dumper->setProvider($this->provider);

        $dumper->setInput($this->input);

        $dumper->setOutput($this->output);

        $dumper->setOptions('help', null);

        $this->addCommand($dumper);
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
        $command->setProvider($this->provider);

        $command->setCollections($this->collections);

        $command->setInput($this->input);

        $command->setOutput($this->output);

        $command->setOptions('help', null);

        $this->collections->setCommand($command, $this->input, $this->output);

        return $this;
    }

    public function printDescription(Command $command)
    {
        $this->output->writeBackground($command->getDescription(), Output::STYLE_BG_NOTICE);
    }

    public function printHelp(Command $command)
    {

    }

    /**
     * @return int
     */
    public function run()
    {
        set_exception_handler(array($this->output, 'onException'));

        set_error_handler(function ($error_no, $error_str, $error_file, $error_line) {
            throw new \ErrorException($error_str, $error_no, 1, $error_file, $error_line);
        });

        $commandName = $this->input->getCommandName();

        $this->input->parseArgumentAndOptions();

        try {
            $command = $this->collections->getCommand($commandName);
        } catch (\InvalidArgumentException $e) {
            $this->collections->executeCommand('command:dump', $this->input, $this->output);
            return 1;
        }

        $command->setCollections($this->collections);

        $command->configure();

        $this->printDescription($command);

        $this->input->setArguments($command->getArguments());
        $this->input->setOptions($command->getOptions());
        $this->input->parseArgumentAndOptions();

        $command->setArguments($this->input->getArguments());
        $command->setOptions($this->input->getOptions());

        $command->execute($this->input, $this->output);

        restore_error_handler();

        restore_exception_handler();

        return 0;
    }
}