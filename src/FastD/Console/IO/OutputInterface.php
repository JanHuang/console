<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/10
 * Time: 下午12:26
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\IO;

interface OutputInterface
{
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
}