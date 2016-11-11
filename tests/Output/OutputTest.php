<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/8
 * Time: 下午8:58
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Tests\Output;

use FastD\Console\Output\ConsoleOutput;
use FastD\Console\Output\OutputFormatter;

/**
 * Class OutputTest
 * @package FastD\Console\Tests\Output
 */
class OutputTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @outputBuffering Hello World
     */
    public function testFormatter()
    {
        $message = OutputFormatter::format('<success>Hello</success> <info>World</info>');
    }

    public function testOutput()
    {
        $output = new ConsoleOutput();

        echo PHP_EOL;
        $output->writeln('Hello <error>World</error>');
        $output->writeln('Hello <success>World</success>');
        $output->writeln('Hello <warning>World</warning>');
        $output->writeln('Hello <notice>World</notice>');
        $output->writeln('Hello <info>World</info>');
        $output->writeln('Hello <default>World</default>');
    }
}