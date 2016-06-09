<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午1:26
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Input;

use FastD\Console\Command\Command;
use ErrorException;

/**
 * Class ArgvInput
 * @package FastD\Console\Input
 */
class ArgvInput extends Input
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param Command $command
     * @throws ErrorException
     */
    public function bindCommand(Command $command)
    {
        $argv = $command->getArgument();

        $inputArguments = $this->getArguments();

        if (!empty($argv)) {
            $this->arguments = array_merge($this->arguments, array_combine(array_keys($argv), array_splice($inputArguments, 0, count($argv))));
        }
    }

    /**
     * @return array
     */
    public function resetCommand()
    {
        foreach ($this->getArguments() as $key => $argument) {
            if (is_string($key)) {
                unset($this->arguments[$key]);
            }
        }
    }
}