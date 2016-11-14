<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Tests\Output;

use FastD\Console\Output\Output;

/**
 * Class OutputTest
 *
 * @package FastD\Console\Tests\Output
 */
class OutputTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Output
     */
    protected $output;

    public function setUp()
    {
        $this->output = new Output();
    }

    public function testOutput()
    {
        $this->output->write("hello world");

        $this->expectOutputString('hello world');
    }

    public function testOutputTable()
    {
        echo PHP_EOL;
        $this->output->table(['FOO', 'BAR', 'FIZZ', 'BUZZ'], [
            ['FOO', 'BAR', 'FIZZ', 'BUZZ'],
            ['FOO', 'BAR', 'FIZZ', 'BUZZ'],
            ['FOO', 'BAR', 'FIZZ', 'BUZZ'],
            ['FOO', 'BAR', 'FIZZ', 'BUZZ'],
            ['Lorem', 'Ipsum', 'Dolor', 'Emit'],
            ['Antiquated', 'Porcupine', 'Sandwich', 'Man'],
        ]);
    }
}
