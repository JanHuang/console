<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/16
 * Time: 下午2:09
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Format;

class Output 
{
    private static $instance;

    const STYLE_NOTICE = 'blue';

    const STYLE_WARNING = '';

    const STYLE_INFO = '';

    const STYLE_BG_NOTICE = '';

    const STYLE_BG_WARNING = '';

    const STYLE_BG_INFO = '';

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function write($message, $style = self::STYLE_INFO)
    {
        echo $this->format($message, $style);
    }

    public function writeln($message, $style = self::STYLE_INFO)
    {
        $this->write($message, $style);

        echo PHP_EOL;
    }

    public function format($message, $style = self::STYLE_INFO)
    {
        return $message;
    }
}