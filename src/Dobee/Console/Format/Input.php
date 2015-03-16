<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/16
 * Time: 下午2:11
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Format;

/**
 * Class Input
 *
 * @package Dobee\Console\Format
 */
class Input
{
    /**
     * @var array
     */
    private $options = array();

    /**
     * @var bool|string
     */
    private $commandName;

    /**
     * @var array
     */
    private $arguments = array();

    /**
     * Constructor;
     */
    public function __construct()
    {
        $this->commandName = $this->parseCommandName();

        $this->parseArgumentAndOptions();
    }

    /**
     * @return bool|string
     */
    public function getCommandName()
    {
        if (null === $this->commandName) {
            $this->commandName = $this->parseCommandName();
        }

        return $this->commandName;
    }

    /**
     * @param $message
     * @return string
     */
    public function systemInput($message)
    {
        Output::getInstance()->write($message);

        return trim(fgets(STDIN));
    }

    /**
     * @return bool|string
     */
    private function parseCommandName()
    {
        if (!isset($_SERVER['argv'][1])) {
            $commandName = $this->systemInput('Please input your command name: ');
            if(empty($commandName)) {
                return false;
            }

            $_SERVER['argv'][1] = $commandName;
        }

        $commandName = $_SERVER['argv'][1];

        array_shift($_SERVER['argv']);
        array_shift($_SERVER['argv']);

        return $commandName;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        if (empty($this->options)) {
            $this->parseArgumentAndOptions();
        }

        return $this->options;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        if (empty($this->arguments)) {
            $this->parseArgumentAndOptions();
        }

        return $this->arguments;
    }

    /**
     * @return bool
     */
    public function parseArgumentAndOptions()
    {
        if (empty($_SERVER['argv'])) {
            return false;
        }

        foreach ($_SERVER['argv'] as $arg) {
            if ('--' === substr($arg, 0, 2)) {
                $pos = strpos($arg, '=');
                $arg = substr($arg, 2);
                if (!$pos) {
                    $this->options[$arg] = null;
                    continue;
                }

                list($name, $value) = explode('=', $arg);

                $this->options[$name] = $value;
            } else {
                $this->arguments[] = $arg;
            }
        }

        return true;
    }
}