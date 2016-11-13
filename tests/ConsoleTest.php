<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/8
 * Time: 下午9:54
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

use FastD\Console\Console;

class ConsoleTest extends PHPUnit_Framework_TestCase
{
    public function testConsole()
    {
        $console = new Console();

        $console->run();
    }
}
