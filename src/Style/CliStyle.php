<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Style;

/**
 * Class CliStyle
 *
 * @package FastD\Console\Style
 */
class CliStyle implements StyleInterface
{
    /**
     * @param $content
     * @return mixed
     */
    public function format($content)
    {
        $content = preg_replace_callback('/\<(?<tag>\/?[a-z]+)\>/', function ($match) {
            if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
                return '';
            }

            if (!array_key_exists($match['tag'], StyleInterface::TAGS) && !array_key_exists(substr($match['tag'], 1), StyleInterface::TAGS)) {
                return '<' . $match['tag'] . '>';
            }

            if ('/' === $match['tag']{0}) {
                // If tag ending.
                return "\033[0m";
            }

            return "\033[" . StyleInterface::TAGS[$match['tag']] . "m";
        }, $content);

        return $content;
    }
}