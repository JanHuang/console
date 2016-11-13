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

use FastD\Console\Input\Input;
use FastD\Console\Input\InputDefinition;

class InputTest extends PHPUnit_Framework_TestCase
{
    protected $definition;

    public function setUp()
    {
        $this->definition = new InputDefinition();
    }

    public function testEmptyInput()
    {
        $input = new Input([]);

        $this->assertEquals('list', $input->getFirstArgument());
        $this->assertEquals('dev', $input->getOption(['e', 'env']));
        $this->assertEmpty($input->getArguments());
        $this->assertEmpty($input->getOptions());

        $input = new Input([], $this->definition);
        $this->assertEquals('list', $input->getFirstArgument());
        $this->assertEquals($input->getFirstArgument(), $input->getArgument('command'));
        $this->assertEmpty($input->getArguments());
        $this->assertEmpty($input->getOptions());
    }

    public function testInputParse()
    {
        $input = new Input([
            'demo.php',
            'test',
            '-vv'
        ]);

        $input->parse();

        $this->assertEquals('test', $input->getFirstArgument());
        $this->assertEquals($input->getFirstArgument(), $input->getArgument('command'));
        $this->assertNull($input->getOption('vvv'));
        $this->assertEquals($input->getOption('debug'), $input->getOption('vvv'));
        $this->assertEquals([
            'command' => 'test'
        ], $input->getArguments());
        $this->assertEquals([
            'vv' => null
        ], $input->getOptions());
    }

    public function testInputParseDefinition()
    {
        $input = new Input([
            'demo.php',
            'demo',
            '--debug=true',
            '--help',
            '-e=prod'
        ], $this->definition);

        $this->assertEquals('demo', $input->getFirstArgument());
        $this->assertEquals($input->getFirstArgument(), $input->getArgument('command'));

        $this->assertNull($input->getOption('debug'));
        $this->assertEquals($input->getOption('vvv'), $input->getOption('debug'));
        $this->assertFalse($input->hasOption('vvv'));
        $this->assertTrue($input->hasOption('debug'));

        $this->assertEquals('prod', $input->getOption('e'));
        $this->assertEquals('prod', $input->getOption('env'));
        $this->assertEquals($input->getOption(['env', 'e']), $input->getOption('e'));

        $this->assertEquals([
            'command' => 'demo'
        ], $input->getArguments());
        $this->assertEquals([
            'debug' => null,
            'help' => null,
            'e' => 'prod'
        ], $input->getOptions());
    }

    public function testEmptyInputBindEmptyDefinition()
    {
        include_once __DIR__ . '/EmptyDefinition.php';

        $input = new Input([], new EmptyDefinition());

        $this->assertFalse($input->getFirstArgument());
        $this->assertEmpty($input->getOptions());
        $this->assertEmpty($input->getArguments());
    }

    public function testInputBindEmptyDefinition()
    {
        include_once __DIR__ . '/EmptyDefinition.php';

        $input = new Input([
            'demo.php',
            'demo',
            '--debug=true',
            '--help',
            '-e=prod'
        ], new EmptyDefinition());

        $this->assertEquals('demo', $input->getFirstArgument());
        $this->assertTrue($input->getOption('debug'));
        $this->assertNull($input->getOption('help'));
        $this->assertEmpty($input->getArguments());
        $this->assertEquals([
            'debug' => true,
            'help' => null,
            'e' => 'prod'
        ], $input->getOptions());
    }

    public function testInputBindMultiDefinition()
    {
        include_once __DIR__ . '/MultiDefinition.php';

        $input = new Input([
            'demo.php',
            'demo',
            '--debug=true',
            '--help',
            '-e=prod'
        ], new MultiDefinition());

        $this->assertEquals('demo', $input->getFirstArgument());
        $this->assertEquals($input->getFirstArgument(), $input->getArgument('foo'));
        $this->assertEquals([
            'foo' => 'demo'
        ], $input->getArguments());
        $this->assertTrue($input->getOption('debug'));
    }

    public function testInputBindNoneDefinition()
    {
        include_once __DIR__ . '/NoneOptionsDefinition.php';

        $input = new Input([
            'demo.php',
            'demo',
            '--foo=true'
        ], new NoneOptionsDefinition());

        $this->assertNull($input->getOption('foo'));
        $this->assertEquals('demo', $input->getArgument('name'));
    }

    public function testInputCustomDefinition()
    {
        include_once __DIR__ . '/CustomDefinition.php';

        $input = new Input([
            'demo.php',
            'demo',
            'true',
            'abc',
            '--foo=true'
        ], new CustomDefinition());

        $this->assertTrue($input->getOption('f'));
        $this->assertEquals($input->getOption('foo'), $input->getOption('f'));
        $this->assertEquals('demo', $input->getArgument('foo'));
        $this->assertTrue($input->getArgument('bar'));
        $this->assertEquals([
            'foo' => 'demo',
            'bar' => true,
        ], $input->getArguments());
    }
}
