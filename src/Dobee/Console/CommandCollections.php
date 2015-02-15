<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:54
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console;

class CommandCollections
{
    private $collections;

    public function addCommand($name, CommandInterface $command)
    {
        if (empty($name)) {
            throw new CommandException(sprintf('%s\' is null or empty.', 'name'));
        }

        $this->collections[$name] = $command;

        return $this;
    }

    public function getCommand($name = null)
    {
        if (null === $name) {
            return $this->collections;
        }

        return $this->collections[$name];
    }
}