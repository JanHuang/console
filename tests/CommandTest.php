<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Tests;

use FastD\Console\ListCommand;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyCommand()
    {
        $listCommand = new ListCommand();

        $this->assertEquals('list', $listCommand->getName());
    }
}
