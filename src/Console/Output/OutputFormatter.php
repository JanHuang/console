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
 * Class OutputFormatter
 * 
 * @package FastD\Console\Output
 */
class OutputFormatter implements OutputFormatterInterface
{
    /**
     * @param $message
     * @return string
     */
    public static function format($message)
    {
        $message = preg_replace_callback('/\<(?<tag>\/?[a-z]+)\>/', function ($match) {
            if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
                return '';
            }

            if ('/' === $match['tag']{0}) {
                // If tag ending.
                return chr(27) . "[0m";
            }

            return chr(27) . OutputFormatterInterface::TAGS[$match['tag']];
        }, $message);

        return $message;
    }
}