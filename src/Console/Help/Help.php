<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午10:43
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Help;

/**
 * Interface HelpInterface
 *
 * @package FastD\Console\Help
 */
abstract class Help
{
    protected $help;

    public function __construct($help = '')
    {
        $this->help = $help;
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        return $this->help;
    }
}