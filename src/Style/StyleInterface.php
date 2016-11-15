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
 * Interface StyleInterface
 *
 * @package FastD\Console\Style
 */
interface StyleInterface
{
    /**
     * @param $name
     * @param ColorInterface $color
     * @return mixed
     */
    public function setColor($name, ColorInterface $color);

    /**
     * @param $name
     * @return mixed
     */
    public function getColor($name);

    /**
     * @param $text
     * @return mixed
     */
    public function format($text);
}