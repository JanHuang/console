<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/8
 * Time: 下午12:06
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console;

use FastD\Console\Input\Input;
use FastD\Console\Output\Output;

/**
 * Interface InvokerInterface
 * 
 * @package FastD\Console
 */
interface InvokerInterface
{
    /**
     * @param Input $input
     * @param Output $output
     * @return mixed
     */
    public function execute(Input $input, Output $output);
}