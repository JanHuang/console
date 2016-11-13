<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Style;

interface StyleInterface
{
    const OUTPUT_ERROR = "0;31";
    const OUTPUT_SUCCESS = "0;32";
    const OUTPUT_WARNING = "0;33";
    const OUTPUT_NOTICE = "0;36";
    const OUTPUT_INFO = "0;34";
    const OUTPUT_DEFAULT = "0;37";

    const TAGS = [
        'error'     => StyleInterface::OUTPUT_ERROR,
        'success'   => StyleInterface::OUTPUT_SUCCESS,
        'warning'   => StyleInterface::OUTPUT_WARNING,
        'notice'    => StyleInterface::OUTPUT_NOTICE,
        'info'      => StyleInterface::OUTPUT_INFO,
        'default'   => StyleInterface::OUTPUT_DEFAULT
    ];

    const COLORS = [
        'red'     => StyleInterface::OUTPUT_ERROR,
        'green'   => StyleInterface::OUTPUT_SUCCESS,
        'yellow'   => StyleInterface::OUTPUT_WARNING,
        'cyan'    => StyleInterface::OUTPUT_NOTICE,
        'blue'      => StyleInterface::OUTPUT_INFO,
        'gray'   => StyleInterface::OUTPUT_DEFAULT
    ];

    public function format($content);
}