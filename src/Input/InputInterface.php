<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
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