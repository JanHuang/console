<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

use FastD\Console\Input\InputDefinition;

class EmptyDefinition extends InputDefinition
{
    public function getDefaultInputArguments()
    {
        return [];
    }

    public function getDefaultInputOptions()
    {
        return [];
    }
}