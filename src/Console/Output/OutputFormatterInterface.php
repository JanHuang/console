<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/8
 * Time: 下午12:02
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Output;

/**
 * Interface OutputFormatterInterface
 * @package FastD\Console\Output
 */
interface OutputFormatterInterface
{
    const SUCCESS = '';
    const WARNING = '';
    const NOTICE = '';
    const INFO = '';

    /**
     * @param $message
     * @return string
     */
    public function format($message);
}