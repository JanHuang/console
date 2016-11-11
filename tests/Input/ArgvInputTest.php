<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Tests\Input;

use FastD\Console\Input\ArgvInput;

class ArgvInputTest extends \PHPUnit_Framework_TestCase
{
    public function testArgvInputDefinitionOptions()
    {
        $argvInput = new ArgvInput([
            'demo.php',
            'test',
            '--debug',
            '-d',
            '-a=b'
        ]);

        $this->assertEquals('test', $argvInput->getFirstArgument());
        $helpOption = $argvInput->getOption('help');
        $this->assertNull($helpOption);
        $short = $argvInput->getOption(['e']);
        $long = $argvInput->getOption(['env']);
        $this->assertEquals($short, $long);
        $this->assertEquals('b', $argvInput->getOption('a'));
    }

    public function testArgvInputDefinitionArguments()
    {
        $argvInput = new ArgvInput([
            'demo.php',
            'test',
            '--debug',
            '-d',
            '-a=b'
        ]);

        print_r($argvInput);
    }
}
