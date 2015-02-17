<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:30
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

use Dobee\Console\Format\InputInterface;
use Dobee\Console\Format\OutputInterface;
use Dobee\Console\Argument\Argument;

class HelloCommand extends \Dobee\Console\Command
{
    public function getName()
    {
        return 'hello';
    }

    public function configure()
    {
        $this
            ->setDescription('hello demo command')
            ->addOption('name', 'janhuang', Argument::OPTIONAL)
            ->addOption('age', 22, Argument::OPTIONAL)
            ->addOption('height', null, Argument::REQUIRED, 'please input height argument')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        var_dump($input->getArgument('name'));
        try {
            $message = $input->getArgument('name');
        } catch (\Dobee\Console\Argument\ArgumentException $e) {
            $message = 'not has argument';
        }

        $output->writeln($message);
    }

    /**
     * return command help information.
     *
     * @return string
     */
    public function help()
    {
        // TODO: Implement help() method.
    }
}