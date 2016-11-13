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

        $input = new Input([], $this->definition);

        $this->assertEquals('list', $input->getFirstArgument());
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
        $this->assertFalse($input->hasOption('vvv'));
        $this->assertEquals($input->getOption('vvv'), $input->getOption('debug'));
        $this->assertTrue($input->hasOption('debug'));

        $this->assertEquals('prod', $input->getOption('e'));
        $this->assertEquals('prod', $input->getOption('env'));
        $this->assertEquals($input->getOption(['env', 'e']), $input->getOption('e'));
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
        $this->assertEquals('true', $input->getOption('debug'));
        $this->assertNull($input->getOption('help'));
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
    }

    public function testInputCustomDefinition()
    {

    }
}
