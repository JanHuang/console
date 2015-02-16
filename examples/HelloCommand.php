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
use Dobee\Console\Format\Input;

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
            ->addOption('name', 'janhuang', Input::OPTIONAL)
            ->addOption('age', 22, Input::OPTIONAL)
            ->addOption('height', null, Input::REQUIRED)
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($input->getArgument('name'));
    }
}