<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Output;

/**
 * Interface OutputFormatterInterface
 * 
 * @package FastD\Console\Output
 */
interface OutputFormatterInterface
{
    const FOR_COLORS = array(
        'black' => array('set' => 30, 'unset' => 39),
        'red' => array('set' => 31, 'unset' => 39),
        'green' => array('set' => 32, 'unset' => 39),
        'yellow' => array('set' => 33, 'unset' => 39),
        'blue' => array('set' => 34, 'unset' => 39),
        'magenta' => array('set' => 35, 'unset' => 39),
        'cyan' => array('set' => 36, 'unset' => 39),
        'white' => array('set' => 37, 'unset' => 39),
        'default' => array('set' => 39, 'unset' => 39),
    );

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