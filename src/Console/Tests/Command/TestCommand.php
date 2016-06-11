<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/11
 * Time: 下午2:44
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Tests\Command;

use FastD\Console\Command\Command;
use FastD\Console\IO\Input;
use FastD\Console\IO\Output;

class TestCommand extends Command
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'base:test';
    }

    /**
     * @return void
     */
    public function configure()
    {
        // TODO: Implement configure() method.
    }

    /**
     * @param Input  $input
     * @param Output $output
     * @return int
     */
    public function execute(Input $input, Output $output)
    {
        // TODO: Implement execute() method.
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        // TODO: Implement getHelp() method.
    }
}