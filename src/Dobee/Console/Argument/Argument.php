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

class Argument implements ArgumentInterface
{
    const REQUIRED = ':';

    const OPTIONAL = '::';

    const VALUE_NONE = '';

    private $argument = array();

    public function parseArgsInput(array $options = array())
    {
        $argInput = array_slice($_SERVER['argv'], 2);

        $arguments = array();

        foreach ($argInput as $val) {
            $args = explode('=', str_replace(array('--', '-'), '', $val));
            if (count($args) <= 1) {
                $value = $options[$args[0]]['value'];
            } else {
                $value = $args[1];
            }

            $arguments[$args[0]] = $value;
        }

        foreach ($options as $key => $value) {
            switch($value['optional']) {
                case Argument::REQUIRED:
                    if (!isset($arguments[$key]) || empty($arguments[$key])) {
                        $arguments[$key] = '';
                        echo sprintf('\'%s\' %s %s: ', $key, $value['notice'], '[' . $value['value'] . ']');
                        $value = trim(fgets(STDIN));
                    } else {
                        $value = $arguments[$key];
                    }
                    break;
                case Argument::OPTIONAL:
                    if (isset($arguments[$key])) {
                        $value = $arguments[$key];
                    } else {
                        $value = $value['value'];
                    }
                    break;
                case Argument::VALUE_NONE:
                    $value = '';
                    break;
            }
            if (isset($arguments[$key])) {
                $this->setArgument($key, $value);
            }
        }

        return $this;
    }

    public function getCommandName()
    {
        if (!isset($_SERVER['argv'][1])) {
            echo 'Please input your command name: ';
            $commandName = trim(fgets(STDIN));
            if(!empty($commandName)) {
                $_SERVER['argv'][1] = $commandName;
            }
        }

        return $_SERVER['argv'][1];
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