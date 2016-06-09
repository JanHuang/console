<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 下午5:12
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Input;

/**
 * Class InputDefinition
 *
 * @package FastD\Console\Input
 */
class InputDefinition
{
    /**
     * @return InputOption[]
     */
    public function getDefaultInputOptions()
    {
        return [
            new InputOption('debug', '-d'),
            new InputOption('help', '-h'),
        ];
    }
}