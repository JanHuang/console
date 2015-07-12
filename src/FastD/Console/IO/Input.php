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

namespace FastD\Console\IO;

/**
 * Class Input
 *
 * @package FastD\Console\Format
 */
class Input
{
    public function systemInput($notice)
    {
        echo $notice . ': ';

        return trim(fgets(STDIN));
    }

    /**
     * @var array
     */
    protected $argv;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Initialize command argv input.
     * @return void
     */
    public function initialize()
    {
        $argv = $_SERVER['argv'];

        array_shift($argv);

        $this->argv = $argv;

        foreach ($argv as $val) {
            if ('-' === substr($val, 0, 1)) {
                $name = $val;
                $value = null;
                if (strpos($val, '=')) {
                    list($name, $value) = explode('=', $val);
                }
                $this->options[$name] = $value;
            } else {
                $this->arguments[] = $val;
            }
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasParameterOption($name)
    {
        if (is_array($name)) {
            foreach ($name as $value) {
                if (isset($this->options[$value])) {
                    return true;
                }
            }

            return false;
        }

        return isset($this->options[$name]) ? true : false;
    }

    /**
     * @param $name
     * @return null|string|int
     */
    public function getParameterOption($name)
    {
        if (is_array($name)) {
            foreach ($name as $value) {
                if ('--' != substr($value, 0, 2)) {
                    $value = '--' . $value;
                }
                if (isset($this->options[$value])) {
                    return $this->options[$value];
                }
            }

            return null;
        }

        if ('--' != substr($name, 0, 2)) {
            $name = '--' . $name;
        }

        return isset($this->options[$name]) ? $this->options[$name] : null;
    }

    /**
     * @param $index
     * @return null|string|int
     */
    public function getParameterArgument($index)
    {
        return isset($this->arguments[$index]) ? $this->arguments[$index] : null;
    }

    /**
     * @return array
     */
    public function getArgv()
    {
        return $this->argv;
    }
}