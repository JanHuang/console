<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:40
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console;

use Dobee\Console\Argument\Argument;
use Dobee\Console\Format\Input;
use Dobee\Console\Format\Output;
use Dobee\Console\Format\Writeln;

/**
 * Console
 *
 * Class Console
 *
 * @package Dobee\Console
 */
class Console
{
    /**
     * @var CommandCollections
     */
    private $command_collections;

    /**
     * @var Input
     */
    protected $input;

    /**
     * @var Output
     */
    protected $output;

    /**
     * Initialize console.
     */
    public function __construct()
    {
        $this->checkEnvironment();

        $this->command_collections = new CommandCollections();

        $this->input = new Input(new Argument());

        $this->output = new Output(new Writeln());
    }

    /**
     * Check console running environment.
     */
    public function checkEnvironment()
    {
        if (PHP_SAPI !== 'cli') {
            exit('Console running environment must should be cli or cmd.');
        }
    }

    /**
     * @param CommandInterface $command
     * @return $this
     */
    public function addCommand(CommandInterface $command)
    {
        $this->command_collections->addCommand($command->getName(), $command);

        return $this;
    }

    /**
     * @return mixed
     * @throws CommandException
     */
    public function run()
    {
        $this->output->writeln('Thank for you use \'Dobee\' console component.');

        $command = $this->command_collections->getCommand($this->input->getCommandName());

        $command->configure();

        $this->output->writeln($command->getDescription());

        $this->input->parseArgsInput($command->getOption());

        if ($this->input->hasArgument('?')) {
            return $command->help();
        }

        return $command->execute($this->input, $this->output);
    }
}