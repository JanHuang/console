<?php

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class ColorTest extends PHPUnit_Framework_TestCase
{
    public function testColorObject()
    {
        $black = new \FastD\Console\Style\Color('black');

        $this->assertEquals(['set' => 30, 'unset' => 39], $black->getForeground());
    }
}
