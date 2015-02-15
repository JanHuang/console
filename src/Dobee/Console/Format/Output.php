<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:51
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Format;

class Output extends Format implements OutputInterface
{
    const SUCCESS = '';

    const NOTICE = 2;

    const WARNING = 3;

    const ERROR = 4;

    public function writeln($message, $style = Output::SUCCESS)
    {
        echo $message . PHP_EOL;
    }
}