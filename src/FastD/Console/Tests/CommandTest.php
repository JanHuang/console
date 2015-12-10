<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/11
 * Time: 上午12:13
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Tests;

use FastD\Console\ArgvInput;
use FastD\Console\Tests\Command\BaseCommand;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testBaseCommand()
    {
        $baseCommand = new BaseCommand();
        $baseCommand->setOption('name');
        $baseCommand->setArgument('age');

        $_SERVER['argv'] = [
            'demo.php',
            '18',
            '--name=janhuang',
        ];

        $argvInput = new ArgvInput();
        $argvInput->recombination($baseCommand);
        print_r($baseCommand);
        print_r($argvInput);
    }
}
