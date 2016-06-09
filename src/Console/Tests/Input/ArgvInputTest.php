<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/9
 * Time: 下午9:48
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Tests\Input;

use FastD\Console\Input\ArgvInput;
use FastD\Console\Input\Input;
use FastD\Console\Tests\Command\BaseCommand;

class ArgvInputTest extends \PHPUnit_Framework_TestCase
{
    public function testArgsInput()
    {
        // -f "value for f" -v -a --required value --optional="optional value" --option
        $_SERVER['argv'] = [
            'demo.php',
            'base',
            '-f',
            'value for f',
            '-v',
            '-a=all',
            '--required=request',
            'value',
            '--optional="optional value"',
            '--option'
        ];

        $argvInput = new Input();

        $this->assertEquals('base', $argvInput->getFirstArgument());
    }

    public function testCommandRecombination()
    {
        $_SERVER['argv'] = [
            'demo.php',
            'base',
            '-f',
            'value for f',
            '-v',
            '-a=all',
            '--required=request',
            'value',
            '--optional="optional value"',
            '--option'
        ];

        $argvInput = new ArgvInput();

        print_r($argvInput);
    }
}
