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

class Console
{
    private $command_collections;

    private $input;

    private $output;

    public function __construct()
    {
        $this->command_collections = new CommandCollections();

        $this->input = new Input(new Argument());

        $this->output = new Output(new Writeln());
    }

    public function addCommand(CommandInterface $command)
    {
        $command->configure();

        foreach ($command->getOption(null) as $key => $val) {
            $this->input->addOption($key, $val['value'], $val['optional'], $val['notice']);
        }

        $this->command_collections->addCommand($command->getName(), $command);

        return $this;
    }

    public function run()
    {
        $this->input->parseArgsInput();

        $command = $this->command_collections->getCommand($this->input->getCommandName());

        return $command->execute($this->input, $this->output);
    }
}