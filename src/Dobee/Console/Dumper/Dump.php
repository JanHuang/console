<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/16
 * Time: 下午2:13
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Dumper;

use Dobee\Console\Commands\Command;
use Dobee\Console\Format\Input;
use Dobee\Console\Format\Output;

class Dump extends Command
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'command:dump';
    }

    /**
     * @return void|$this
     */
    public function configure()
    {
        $this->setArguments('name', null, Command::ARG_REQUIRED);
        $this->setDescription('Thank for you use command dump tool.');
    }

    /**
     * @param Input  $input
     * @param Output $output
     * @return void
     */
    public function execute(Input $input, Output $output)
    {
        if ('' == $input->get('name')) {
            $this->output->writeln("name" . str_repeat(' ', 21) . "arguments" . str_repeat(' ', 23) . "options", Output::STYLE_SUCCESS);

            foreach ($this->collections as $name => $command) {
                $options = implode(',', array_keys($command->getOptions()));
                $arguments = implode(',', array_keys($command->getArguments()));
                $this->output->write($command->getName() . str_repeat(' ', 30 - strlen($command->getName())));
                $this->output->write($arguments . str_repeat(' ', 30 - strlen($arguments)));
                $this->output->writeln($options . str_repeat(' ', 30 - strlen($options)));
            }

            return ;
        }

        $command = $this->getCommand($input->get('name'));

        $this->output->writeln($command);
    }
}