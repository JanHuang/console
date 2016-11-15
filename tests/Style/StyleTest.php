<?php
use FastD\Console\Style\Style;

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class StyleTest extends PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        $style = new Style();

        $text = $style->format('<error>hello</error>asdadsf<info>world</info>');

        echo $text;
    }

    public function testTableFormat()
    {
        $style = new \FastD\Console\Style\Table();

        $style->setHeader(['Name', "Age"]);

        $table = $style->format([
            ['<green>Ken</green>', '<red>18</red>']
        ]);

        echo $table;
    }
}
