<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 下午1:54
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Tests\Input;

use FastD\Console\Input\InputArgument;

class InputArgumentTest extends \PHPUnit_Framework_TestCase
{
    public function testArgument()
    {
        $argument = new InputArgument('name', InputArgument::OPTIONAL, '', 'jan');

        $this->assertEquals('jan', $argument->getValue());

        $this->assertEquals('name', $argument->getName());
    }
}
