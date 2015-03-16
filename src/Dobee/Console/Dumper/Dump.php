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
        $this->output->writeln("id\tname\t", Output::STYLE_SUCCESS);

        if ('' == $input->get('name')) {
            $i = 1;
            foreach ($this->collections as $name => $command) {
                $this->output->write($i++ . "\t");
                $this->output->writeln($command->getName());
            }

            return ;
        }

        try {
            $command = $this->getCommand($input->get('name'));
        } catch (\Exception $e) {

        }

//        $output->writeln($command->getName());
    }
}