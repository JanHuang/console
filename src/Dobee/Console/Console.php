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

use Dobee\Console\Format\Input;
use Dobee\Console\Format\Output;

class Console
{
    private $command_collections;

    private $input;

    private $output;

    public function __construct(CommandCollections $collections)
    {
        $this->command_collections = $collections;

        $this->input = new Input();

        $this->output = new Output();
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

    public function run(CommandInterface $command = null)
    {
        $this->input->parseArgsInput();

        if (null === $command) {
            foreach ($this->command_collections->getCommand(null) as $command) {
                $command->execute($this->input, $this->output);
            }

            return 1;
        }

        return $command->execute($this->input, $this->output);
    }
}