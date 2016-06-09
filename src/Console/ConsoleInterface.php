<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/30
 * Time: 上午10:49
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console;

use FastD\Console\Input\ArgvInput;

/**
 * Interface ConsoleInterface
 * 
 * @package FastD\Console
 */
interface ConsoleInterface
{
    /**
     * @param ArgvInput $input
     * @return mixed
     */
    public function run(ArgvInput $input);
}