<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 下午1:40
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Tests\Input;

use FastD\Console\Input\InputOption;

class InputOptionTest extends \PHPUnit_Framework_TestCase
{
    public function testOption()
    {
        $option = new InputOption('name', '-a');

        $this->assertEquals('name', $option->getName());

        $this->assertEquals('-a', $option->getShortcut());

        $this->assertTrue($option->isOptional());

        $option = new InputOption('--name', '-a');

        $this->assertEquals('name', $option->getName());

        $option = new InputOption('name', '-a|-aa', InputOption::VALUE_NONE, 'hello world', 'default');

        $this->assertEquals('default', $option->getValue());

        $this->assertEquals('hello world', $option->getDescription());

        $this->assertEquals('-a|-aa', $option->getShortcut());

        $this->assertTrue($option->isNone());
    }
}
