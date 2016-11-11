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
    public function testInputArgumentsParse()
    {
        $argvInput = new Input([
            'demo.php',
            'test',
            '--debug',
        ]);

        $arguments = $argvInput->getArguments();
        $options = $argvInput->getOptions();

        $this->assertArrayHasKey('debug', $options);
        $this->assertEquals([
            'debug' => null,
        ], $options);
        $this->assertEquals(['test'], $arguments);
        $this->assertEquals('test',  $argvInput->getFirstArgument());
        $this->assertNull($argvInput->getOption('debug'));
        $this->assertNull($argvInput->getOption([
            'debug'
        ]));
        $this->assertTrue($argvInput->hasOption('debug'));
    }

    public function testInputMultiArgumentsParse()
    {
        $argvInput = new Input([
            'demo.php',
            'test',
            '--debug',
            '-d',
            '-a=b'
        ]);

        $this->assertEquals([
            'debug' => null,
            'd' => null,
            'a' => 'b'
        ], $argvInput->getOptions());

        $this->assertEquals(['test'], $argvInput->getArguments());
    }

    public function testInputArrayOptions()
    {
        $argvInput = new Input([
            'demo.php',
            'test',
            '-d',
            '-a=b'
        ]);

        $this->assertFalse($argvInput->hasOption('debug'));
        $this->assertNull($argvInput->getOption(['debug', 'd']));

        $argvInput = new Input([
            'demo.php',
            'test',
            '--debug',
            '-a=b'
        ]);

        $this->assertTrue($argvInput->hasOption('debug'));
        $this->assertNull($argvInput->getOption(['d', 'debug']));
    }
}
