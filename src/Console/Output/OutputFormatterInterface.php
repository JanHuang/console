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
 * 
 * @package FastD\Console\Output
 */
interface OutputFormatterInterface
{
    const OUTPUT_ERROR = "0;31";
    const OUTPUT_SUCCESS = "0;32";
    const OUTPUT_WARNING = "0;33";
    const OUTPUT_NOTICE = "0;36";
    const OUTPUT_INFO = "0;34";
    const OUTPUT_DEFAULT = "0;37";
    
    const TAGS = [
        'error'     => OutputFormatterInterface::OUTPUT_ERROR,
        'success'   => OutputFormatterInterface::OUTPUT_SUCCESS,
        'warning'   => OutputFormatterInterface::OUTPUT_WARNING,
        'notice'    => OutputFormatterInterface::OUTPUT_NOTICE,
        'info'      => OutputFormatterInterface::OUTPUT_INFO,
        'default'   => OutputFormatterInterface::OUTPUT_DEFAULT
    ];

    /**
     * @param $message
     * @return string
     */
    public static function format($message);
}