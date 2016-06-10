<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 下午5:08
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Tests\Command;

use FastD\Console\Input\InputArgument;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testArguments()
    {
        $command = new BaseCommand();

        $command->setArgument('name', InputArgument::REQUIRED);
        $command->setOption('age', '-a');
    }
}
