<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午1:14
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Argument;

interface ArgumentInterface
{
    public function setCommandName($command_name);

    public function getCommandName();

    public function hasArgument($key);

    public function setArgument($key, $value);

    public function getArgument($key);
}