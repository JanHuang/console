<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

use FastD\Console\Console;

class ConsoleTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyInputConsole()
    {
        include_once __DIR__ . '/OutputHelloCommand.php';
        include_once __DIR__ . '/OutputWorldCommand.php';

        $console = new Console(new \FastD\Console\Input\Input([]));

        $console->run();
    }

    public function testHelloCommandInputConsole()
    {
        include_once __DIR__ . '/OutputHelloCommand.php';
        include_once __DIR__ . '/OutputWorldCommand.php';

        $console = new Console(new \FastD\Console\Input\Input([
            'demo.php',
            'hello'
        ]));

        $console->addCommand(new OutputHelloCommand());
        $console->addCommand(new OutputWorldCommand());

        $console->run();

        $this->expectOutputString('hello');
    }

    public function testWorldCommandInputConsole()
    {
        include_once __DIR__ . '/OutputHelloCommand.php';
        include_once __DIR__ . '/OutputWorldCommand.php';

        $console = new Console(new \FastD\Console\Input\Input([
            'demo.php',
            'world'
        ]));

        $console->addCommand(new OutputHelloCommand());
        $console->addCommand(new OutputWorldCommand());

        $console->run();

        $this->expectOutputString('world');
    }
}
