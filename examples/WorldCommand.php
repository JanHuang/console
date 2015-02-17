<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/17
 * Time: 下午5:20
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */
class WorldCommand extends \Dobee\Console\Command
{
    /**
     * return command help information.
     *
     * @return string
     */
    public function help()
    {
        // TODO: Implement help() method.
    }

    public function getName()
    {
        return 'world';
    }

    public function configure()
    {

    }

    public function execute(\Dobee\Console\Format\InputInterface $input, \Dobee\Console\Format\OutputInterface $output)
    {
        $output->writeln('world');
    }
}