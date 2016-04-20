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
use FastD\Console\IO\Input;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testBaseCommand()
    {
        $baseCommand = new BaseCommand();
        $baseCommand->setOption('name');
        $baseCommand->setOption('height', Input::ARG_NONE);
        $baseCommand->setArgument('age');

        $_SERVER['argv'] = [
            'demo.php',
            'base:demo',
            '18',
            '--name=janhuang',
            '--height="188"',
            '--env=dev'
        ];

        $argvInput = new ArgvInput();
        $this->assertTrue($argvInput->has(['--env', '-e']));
        // context equals
        $this->assertTrue($argvInput->has(['env', 'e']));
        $argvInput->recombination($baseCommand);

        $this->assertEquals(18, $argvInput->get('age'));
        $this->assertEquals('janhuang', $argvInput->get('name'));
        $this->assertNull($argvInput->get('height'));
    }
}
