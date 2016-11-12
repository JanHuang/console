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

use FastD\Console\Input\Input;

class InputTest extends \PHPUnit_Framework_TestCase
{
    public function testArgumentDefaultFormat()
    {
        $input = new Input([
            'demo.php',
            '-a',
            'b',
            '-vv',
        ]);

        $args = $input->formatInputArguments();

        $this->assertEquals([
            '-a=b',
            '-vv'
        ], $args);
    }

    public function testArgumentCombinationFormat()
    {
        $input = new Input([
            'demo.php',
            '-a',
            'b',
            '-vv=1',
            'test',
        ]);

        $args = $input->formatInputArguments();
        $this->assertEquals([
            '-a=b',
            '-vv=1',
            'test'
        ], $args);
    }

    public function testArgumentShortcutFormat()
    {
        $input = new Input([
            'demo.php',
            'test',
            '-a=b',
            '-c',
            'd',
            '-vv',
            '-e=prod'
        ]);

        $args = $input->formatInputArguments();
        $this->assertEquals([
            'test',
            '-a=b',
            '-c=d',
            '-vv',
            '-e=prod'
        ], $args);
    }

    public function testArgumentWithCombinationFormat()
    {
        $input = new Input([
            'demo.php',
            'test',
            '-a=b',
            '-c',
            'd',
            '-vv',
            '-h127.0.0.1',
            '-e=prod'
        ]);

        $args = $input->formatInputArguments();
        print_r($args);
    }

    public function testArgumentsMixinFormat()
    {
        $input = new Input([
            'demo.php',
            'test',
            '-a=b',
            '-c',
            'd',
            'e',
            '-vv',
            '-e=prod'
        ]);

        $args = $input->formatInputArguments();
        $this->assertEquals([
            'test',
            '-a=b',
            '-c=d',
            'e',
            '-vv',
            '-e=prod'
        ], $args);
    }

    public function testEmptyInput()
    {
        $argvInput = new Input([]);

        $this->assertEquals($argvInput->getArguments(), [
            'command' => 'list'
        ]);
        $this->assertEmpty($argvInput->getOptions());
        // has CLI input arg?
        $this->assertFalse($argvInput->hasOption('debug'));
        $this->assertFalse($argvInput->hasOption('env'));
        // get InputDefinition option.
        $this->assertEquals('dev', $argvInput->getOption('env'));
        $this->assertEquals($argvInput->getOption('e'), $argvInput->getOption('env'));
        $isDebug = $argvInput->getOption('debug');
        $this->assertNull($isDebug);
        $this->assertEquals('list', $argvInput->getFirstArgument());
    }

    public function testInputCommandArgument()
    {
        $input = new Input([
            'demo.php',
            'test',
            '-a=b',
            '-vv',
            '-e=prod'
        ]);

        $this->assertTrue($input->hasOption(['debug', 'vv']));
        $this->assertNull($input->getOption('vv'));
        $this->assertEquals('prod', $input->getOption(['e', 'env']));
    }

    public function testDefaultCommandExecute()
    {
        $input = new Input([
            'demo.php',
            '-a=b',
            '-vv',
        ]);

        $this->assertEquals('list', $input->getFirstArgument());
        $this->assertEquals('list', $input->getArgument('command'));
    }

    public function testDefaultEqualsAssignArguments()
    {
        $input = new Input([
            'demo.php',
            '-a=b',
            '-vv',
        ]);

        $this->assertEquals('b', $input->getOption('a'));
        $this->assertNull($input->getOption('vv'));
    }

    public function testCombinationAssignArguments()
    {
        $input = new Input([
            'demo.php',
            '-a',
            'b',
            '-vv',
        ]);

        $this->assertEquals('b', $input->getOption('a'));
    }

    public function testWithArguments()
    {
        $input = new Input([
            'demo.php',
            '-a',
            'b',
            '-vv',
        ]);
    }

    public function testShortcutOptions()
    {
        $input = new Input([
            'demo.php',
            '-a',
            'b',
            '-vv',
        ]);

        $this->assertEquals('b', $input->getOption('a'));
    }

    public function testLongOptions()
    {
        $input = new Input([
            'demo.php',
            '-a',
            'b',
            '--foo=bar',
        ]);

        $this->assertEquals('bar', $input->getOption('foo'));
    }

    public function testShortcutLongMixinOptions()
    {
        $input = new Input([
            'demo.php',
            '-a',
            'b',
            '--foo=bar',
        ]);

        $this->assertEquals('bar', $input->getOption('foo'));
        $this->assertEquals('b', $input->getOption('a'));
    }
}
