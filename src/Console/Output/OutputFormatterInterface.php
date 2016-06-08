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
    const OUTPUT_FAILURE = "[31m";
    const OUTPUT_SUCCESS = "[32m";
    const OUTPUT_WARNING = "[33m";
    const OUTPUT_NOTICE = "[34m";
    const OUTPUT_INFO = "[36m";
    const OUTPUT_DEFAULT = "[37m";
    
    const TAGS = [
        'failure' => OutputFormatterInterface::OUTPUT_FAILURE,
        'success' => OutputFormatterInterface::OUTPUT_SUCCESS,
        'warning' => OutputFormatterInterface::OUTPUT_WARNING,
        'notice' => OutputFormatterInterface::OUTPUT_NOTICE,
        'info' => OutputFormatterInterface::OUTPUT_INFO,
        'default' => OutputFormatterInterface::OUTPUT_INFO
    ];

    /**
     * @param $message
     * @return string
     */
    public static function format($message);
}