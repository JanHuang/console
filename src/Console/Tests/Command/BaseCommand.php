<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/11
 * Time: 上午12:14
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

class BaseCommand extends Command
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'test:demo';
    }

    /**
     * @return void
     */
    public function configure()
    {
        $this->setArgument('name');
        $this->setOption('age', Input::ARG_OPTIONAL);
    }

    /**
     * @param Input  $input
     * @param Output $output
     * @return int
     */
    public function execute(Input $input, Output $output)
    {
        echo 'hello ' . $input->get('name');
    }
}