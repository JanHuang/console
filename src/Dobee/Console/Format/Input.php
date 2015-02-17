<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:50
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Format;

use Dobee\Console\Argument\ArgumentInterface;

class Input implements InputInterface
{
    private $arguments = array();

    public function __construct(ArgumentInterface $argumentInterface)
    {
        $this->arguments = $argumentInterface;
    }

    public function getCommandName()
    {
        return $this->arguments->getCommandName();
    }

    public function parseArgsInput(array $options = array())
    {
        return $this->arguments->parseArgsInput($options);
    }

    public function hasArgument($key)
    {
        return $this->arguments->hasArgument($key);
    }

    public function getArgument($key)
    {
        return $this->arguments->getArgument($key);
    }
}