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
use FastD\Console\Input\InputDefinition;
use FastD\Console\Tests\Command\BaseCommand;

class ArgvInputTest extends \PHPUnit_Framework_TestCase
{
    public function testArgsInput()
    {
        $definition = new InputDefinition();

        $argvInput = new Input([
            'demo.php',
            'test',
            '--debug',
            '-d'
        ]);

        $argvInput->bind($definition);

        $this->assertEquals($argvInput->getArguments(), ['command' => 'test']);
        $this->assertEquals($argvInput->getOptions(), ['debug' => null]);
    }

    public function testAnyoneOptionInput()
    {
        $definition = new InputDefinition();

        $argvInput = new Input([
            'demo.php',
            'test',
            '-d'
        ]);

        $argvInput->bind($definition);

        $this->assertEquals($argvInput->getArguments(), ['command' => 'test']);
        $this->assertEquals($argvInput->getOptions(), ['debug' => null]);

        $argvInput = new Input([
            'demo.php',
            'test',
            '--debug'
        ]);

        $argvInput->bind($definition);

        $this->assertEquals($argvInput->getArguments(), ['command' => 'test']);
        $this->assertEquals($argvInput->getOptions(), ['debug' => null]);
    }
}
