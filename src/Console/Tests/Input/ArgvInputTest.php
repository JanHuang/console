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
use FastD\Console\Input\InputArgument;
use FastD\Console\Input\InputDefinition;
use FastD\Console\Input\InputOption;
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

    public function testOptionValueRequired()
    {
        $definition = new InputDefinition();

        $argvInput = new Input([
            'demo.php',
            'test',
            '-d=debug'
        ]);

        $argvInput->bind($definition);

        $this->assertEquals($argvInput->getArguments(), ['command' => 'test']);
        $this->assertEquals($argvInput->getOptions(), ['debug' => null]);
        $this->assertEquals('test', $argvInput->getCommandName());
    }
    
    public function testOptionValueArrayGet()
    {
        $definition = new InputDefinition();
        $definition->setOption(new InputOption('name', '-n'));
        $definition->setOption(new InputOption('age', '-a|-aa', InputOption::VALUE_REQUIRED));
        $definition->setOption(new InputOption('default', null, InputOption::VALUE_REQUIRED, 'default', 'ddddd'));
        $definition->setArgument(new InputArgument('ok'));
        $definition->setArgument(new InputArgument('d', InputArgument::REQUIRED, '', 'abc'));

        $argvInput = new Input([
            'demo.php',
            'test',
            '-d=debug',
            '--name=jan',
            '-n=jan',
            '-aa=18',
            '123'
        ]);

        $argvInput->bind($definition);

        $this->assertEquals(null, $argvInput->getOption('d'));
        $this->assertEquals(null, $argvInput->getOption('debug'));
        $this->assertEquals('jan', $argvInput->getOption('name'));
        $this->assertEquals('ddddd', $argvInput->getOption('default'));
        $this->assertEquals('123', $argvInput->getArgument('ok'));
        $this->assertEquals('18', $argvInput->getOption('age'));
        $this->assertEquals('jan', $argvInput->getOption(['name', 'n']));
        $this->assertEquals('abc', $argvInput->getArgument('d'));

        print_r($argvInput);
    }
}
