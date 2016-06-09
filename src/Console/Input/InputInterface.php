<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 下午5:52
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Input;

/**
 * Interface InputInterface
 *
 * @package FastD\Console\Input
 */
interface InputInterface
{
    /**
     * @return mixed
     */
    public function resetOptions();

    /**
     * @return mixed
     */
    public function resetArguments();
}