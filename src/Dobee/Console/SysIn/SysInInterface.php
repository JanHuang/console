<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/16
 * Time: 下午9:44
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\SysIn;

interface SysInInterface
{
    public function step();

    public function run();

    public function getName();
}