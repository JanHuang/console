<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Tests\Input;

use FastD\Console\Command\ListCommand;
use FastD\Console\Input\ArgvInput;

class ArgvInputTest extends \PHPUnit_Framework_TestCase
{
    public function testArgvInputDefinition()
    {
        $argvInput = new ArgvInput([
            'demo.php',
            'test',
            '--debug',
            '-d',
            '-a=b'
        ]);

        $missing = $argvInput->bindCommand(new ListCommand());

        print_r($argvInput);
        print_r($missing);
    }
}
