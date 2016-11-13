<?php

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class MultiDefinition extends \FastD\Console\Input\InputDefinition
{
    public function getDefaultInputArguments()
    {
        return [
            new \FastD\Console\Input\InputArgument('foo', \FastD\Console\Input\InputArgument::OPTIONAL, 'name', 'bar')
        ];
    }

    public function getDefaultInputOptions()
    {
        return [
            new \FastD\Console\Input\InputOption('foo', '-f')
        ];

    }
}