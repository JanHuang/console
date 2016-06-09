<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午10:17
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Output;

use FastD\Console\Help\Help;

class ConsoleOutput extends Output
{
    public function writeHelp(Help $help)
    {
        echo $help->getHelp();
    }
}