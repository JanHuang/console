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

namespace FastD\Console\Format;

use FastD\Console\Commands\Command;
use FastD\Console\Commands\Option;
use FastD\Console\Commands\Argument;

/**
 * Class Input
 *
 * @package FastD\Console\Format
 */
class Input extends Output
{
    /**
     * @var Option[]
     */
    private $options = array();

    /**
     * @var bool|string
     */
    private $commandName;

    /**
     * @var Argument[]
     */
    private $arguments = array();

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
        $this->write($message, Output::STYLE_INFO);

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
        } else {
            $commandName = $_SERVER['argv'][1];
        }

        array_shift($_SERVER['argv']);
        array_shift($_SERVER['argv']);

        return $commandName;
    }

    /**
     * @param      $name
     * @param null $value
     * @return $this
     */
    public function setOptions($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $this->options[$key] = $value;
            }
         } else {
            $this->options[$name] = $value;
        }

        return $this;
    }

    /**
     * @param      $name
     * @param null $value
     * @return $this
     */
    public function setArguments($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $this->arguments[$key] = $value;
            }
        } else {
            $this->arguments[$name] = $value;
        }

        return $this;
    }

    /**
     * @param null|string $name
     * @return Option[]|Option
     */
    public function getOptions($name = null)
    {
        if (null === $name) {
            return $this->options;
        }

        return $this->options[$name];
    }

    /**
     * @param null|string $name
     * @return Argument
     */
    public function getArguments($name = null)
    {
        if (null === $name) {
            return $this->arguments;
        }

        return $this->arguments[$name];
    }

    /**
     * @param $name
     * @return bool|mixed
     */
    public function get($name)
    {
        if (isset($this->arguments[$name])) {
            return $this->arguments[$name]->getValue();
        }

        if (isset($this->options[$name])) {
            return $this->options[$name]->getValue();
        }

        return false;
    }

    /**
     * @return bool
     */
    public function parseArgumentAndOptions()
    {
        foreach ($_SERVER['argv'] as $arg) {
            if ('--' === substr($arg, 0, 2)) {
                $pos = strpos($arg, '=');
                $arg = substr($arg, 2);
                if (!$pos) {
                    $this->options[$arg]->setValue(null);
                    continue;
                }

                list($name, $value) = explode('=', $arg);

                $this->options[$name]->setValue($value);
            } else {
                $key = key($this->arguments);
                if (isset($this->arguments[$key])) {
                    $this->arguments[key($this->arguments)]->setValue($arg);
                    next($this->arguments);
                }
            }
        }

        foreach ($this->arguments as $name => $argument) {
            if ($argument->getOptional() === Command::ARG_REQUIRED && '' == $argument->getValue()) {
                $value = $this->systemInput(sprintf('Please input you argument value [%s]: ', $argument->getName()));
                $this->arguments[$name]->setValue($value);
            }
        }

        foreach ($this->options as $name => $option) {
            if ($option->getOptional() === Command::ARG_REQUIRED && '' == $option->getValue()) {
                $value = $this->systemInput(sprintf('Please input you option value [%s]: ', $option->getName()));
                $this->options[$name]->setValue($value);
            }
        }

        return true;
    }
}