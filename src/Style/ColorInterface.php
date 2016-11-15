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
interface ColorInterface
{
    /**
     * @param string $color The color name
     */
    public function setForeground($color = null);

    /**
     * @return string
     */
    public function getForeground();

    /**
     * @param string $color The color name
     */
    public function setBackground($color = null);

    /**
     * @return string
     */
    public function getBackground();

    /**
     * @param $text
     * @return string
     */
    public function render($text);
}