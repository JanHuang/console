<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午1:15
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Argument;

use Dobee\Console\Format\Input;

class Argument implements ArgumentInterface
{
    private $command_name;

    private $argument = array();

    public function parse(array $options = array())
    {
        $arguments = isset($_SERVER['argv']) ? $_SERVER['argv'] : array();

        if (!isset($arguments[1]) || '-' === substr($arguments[1], 0, 1)) {
            throw new ArgumentException(sprintf('The first argument must be a command name'));
        }

        $this->setCommandName($arguments[1]);

        $arguments = array_slice($_SERVER['argv'], 2);

        foreach ($arguments as $val) {
            $opt = explode('=', str_replace(array('--', '-',), '', $val));
            $key = $opt[0];
            $value = isset($opt[1]) ? $opt[1] : null;
            $this->setArgument($key, $value);
        }

        return $this;
    }

    public function setCommandName($command_name)
    {
        $this->command_name = $command_name;

        return $this;
    }

    public function getCommandName()
    {
        return $this->command_name;
    }

    public function setArgument($key, $value)
    {
        $this->argument[$key] = $value;

        return $this;
    }

    public function getArgument($key)
    {
        if (!$this->hasArgument($key)) {
            throw new ArgumentException(sprintf('%s\' is undefined.', $key));
        }

        return $this->argument[$key];
    }

    public function hasArgument($key)
    {
        return isset($this->argument[$key]);
    }
}