<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/10
 * Time: 下午12:11
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\IO;

interface InputInterface
{
    const ARG_NONE      = '';
    const ARG_REQUIRED  = ':';
    const ARG_OPTIONAL  = '::';

    const ARG_LONG      = 1;
    const ARG_SHORT     = 2;
}