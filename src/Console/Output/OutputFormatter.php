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

            if (!array_key_exists($match['tag'], OutputFormatterInterface::TAGS) && !array_key_exists(substr($match['tag'], 1), OutputFormatterInterface::TAGS)) {
                return '<' . $match['tag'] . '>';
            }

            if ('/' === $match['tag']{0}) {
                // If tag ending.
                return "\033[0m";
            }

            return "\033[" . OutputFormatterInterface::TAGS[$match['tag']] . "m";
        }, $message);

        return $message;
    }
}