<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

use FastD\Console\Input\InputDefinition;

class NoneOptionsDefinition extends InputDefinition
{
    public function getDefaultInputArguments()
    {
        return [
            new \FastD\Console\Input\InputArgument('name'),
        ];
    }

    public function getDefaultInputOptions()
    {
        return [
             new \FastD\Console\Input\InputOption('foo', '-f', \FastD\Console\Input\InputOption::VALUE_NONE),
        ];
    }
}