<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/28
 * Time: 下午10:43
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console;

use FastD\Console\IO\Input;

/**
 * Class ArgvInput
 *
 * @package FastD\Console
 */
class ArgvInput extends Input
{
    /**
     * @var string|null
     */
    protected $commandName;

    /**
     * @return bool
     */
    public function emptyArgv()
    {
        return empty($this->argv);
    }

    /**
     * @return null|string
     */
    public function getCommandName()
    {
        if (null !== $this->commandName) {
            return $this->commandName;
        }

        if (empty($this->argv)) {
            return $this->systemInput('Please input command name');
        }

        $this->commandName = array_shift($this->arguments); array_shift($this->argv);

        return $this->commandName;
    }
}