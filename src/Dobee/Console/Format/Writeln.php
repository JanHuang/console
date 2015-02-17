<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/16
 * Time: 下午9:39
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Format;

class Writeln implements FormatInterface
{
    const SUCCESS = '[32m';

    const NOTICE = '[34m';

    const WARNING = '[43m';

    const ERROR = '[41m';

    public function writeln($message, $style = Writeln::SUCCESS)
    {
        echo chr(27) . $style . $message . chr(27) . "[0m" . PHP_EOL;
    }
}