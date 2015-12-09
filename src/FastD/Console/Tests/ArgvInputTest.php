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

namespace FastD\Console\Tests;

use FastD\Console\ArgvInput;

class ArgvInputTest extends \PHPUnit_Framework_TestCase
{
    public function testInput()
    {
        $_SERVER['argv'] = [];
        $argvInput = new ArgvInput();
        print_r($argvInput);
    }

    public function testArgsInput()
    {
        $_SERVER['argv'] = [
            'demo.php',
            '--name=janhuang',
            '--debug',
        ];
        $argvInput = new ArgvInput();
    }
}
