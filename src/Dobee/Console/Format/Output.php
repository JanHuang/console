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

/**
 * Class Output
 *
 * @package Dobee\Console\Format
 */
class Output
{
    /**
     * @var $this
     */
    private static $instance;

    // font color
    /**
     *
     */
    const STYLE_FAILURE = '[31m';

    /**
     * @const string
     */
    const STYLE_SUCCESS = '[32m';

    /**
     * @const string
     */
    const STYLE_WARNING = '[33m';

    /**
     * @const string
     */
    const STYLE_NOTICE = '[34m';

    /**
     * @const string
     */
    const STYLE_INFO = '[36m';

    /**
     * @const string
     */
    const STYLE_DEFAULT = '[37m';

    /**
     * @const string
     */
    const STYLE_BG_FAILURE = '[41m';

    /**
     * @const string
     */
    const STYLE_BG_SUCCESS = '[42m';

    /**
     * @const string
     */
    const STYLE_BG_WARNING = '[43m';

    /**
     * @const string
     */
    const STYLE_BG_NOTICE = '[44m';

    /**
     * @const string
     */
    const STYLE_BG_INFO = '[46m';

    /**
     * @const string
     */
    const STYLE_BG_DEFAULT = '[47m';

    /**
     * @return Output
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param        $message
     * @param string $style
     */
    public function write($message, $style = self::STYLE_DEFAULT)
    {
        echo $this->format($message, $style);
    }

    /**
     * @param        $message
     * @param string $style
     */
    public function writeln($message, $style = self::STYLE_DEFAULT)
    {
        $this->write($message, $style);

        echo PHP_EOL;
    }

    /**
     * @param        $message
     * @param string $style
     * @return string
     */
    public function format($message, $style = self::STYLE_DEFAULT)
    {
        return chr(27) . $style . $message . chr(27) . "[0m";
    }
}