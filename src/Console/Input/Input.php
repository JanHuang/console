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

namespace FastD\Console\Input;

use Exception;

/**
 * Class Input
 *
 * @package FastD\Console\Input
 */
class Input
{
    /**
     * @var string
     */
    protected $command;

    /**
     * Server argv.
     *
     * @var array
     */
    protected $argv;

    /**
     * 长选项 "--option" 长选项会自动追加短选项到参数中 (默认), 可覆盖
     *
     * @var array
     */
    protected $longOptions = [];

    /**
     * 短选项 "-o"
     *
     * @var array
     */
    protected $shortOptions = [];

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->argv = $_SERVER['argv'];

        array_shift($this->argv); // 去除执行脚本

        $this->command = array_shift($this->argv);

        // 保留关键字, 可被覆盖
        $this->shortOptions['-h'] = null;
        $this->longOptions['--help'] = null;

        $this->parse($this->argv);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->argv);
    }

    /**
     * @return null|string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param array $argv
     * @return void
     */
    protected function parse(array $argv = [])
    {
        foreach ($argv as $value) {
            if ('--' === substr($value, 0, 2)) {
                $this->parseLongOptions($value);
            } else if ('-' === substr($value, 0, 1)) {
                $this->parseShortOptions($value);
            } else {
                $this->parseArguments($value);
            }
        }
    }

    /**
     * @param $argument
     * @return $this
     */
    protected function parseArguments($argument)
    {
        $this->arguments[] = $argument;

        return $this;
    }

    /**
     * @param $option
     * @return $this
     */
    protected function parseLongOptions($option)
    {
        if (false === ($index = strpos($option, '='))) {
            $key = $option;
            $value = null;
        } else {
            $key = substr($option, 0, $index - 2);
            $value = trim(substr($option, ($index + 1)), "\'\"");
        }

        $this->longOptions[$key] = $value;

        $shortOption = substr($key, 1, 2);

        if (!isset($this->shortOptions[$shortOption])) {
            $this->shortOptions[$shortOption] = $value;
        }

        return $this;
    }

    /**
     * @param $option
     * @return $this
     */
    protected function parseShortOptions($option)
    {
        if (false === ($index = strpos($option, '='))) {
            $key = substr($option, 0);
            $value = null;
        } else {
            $key = substr($option, 0, $index);
            $value = trim(substr($option, ($index + 1)), "\'\"");
        }

        $this->shortOptions[$key] = $value;

        return $this;
    }

    /**
     * @param $name
     * @return bool|null
     */
    public function has($name)
    {
        try {
            return $this->get($name);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $name
     * @return bool|null
     */
    public function get($name)
    {
        $get = function ($name) {
            if (array_key_exists('--' . $name, $this->longOptions)) {
                return $this->longOptions['--' . $name];
            }
            if (array_key_exists('-' . $name, $this->shortOptions)) {
                return $this->shortOptions['-' . $name];
            }
            if (array_key_exists($name, $this->arguments)) {
                return $this->arguments[$name];
            }
            throw new Exception(sprintf('Parameter ["%s"] is undefined.', $name));
        };

        if (is_array($name)) {
            foreach ($name as $value) {
                try {
                    return $get($value);
                } catch (Exception $e) {
                    continue;
                }
            }
            return null;
        }

        try {
            return $get($name);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function hasGet($name, $default = null)
    {
        return null === ($value = $this->get($name)) ? $default : $value;
    }

    public function addLongOption(InputOption $options)
    {

    }

    /**
     * @return array
     */
    public function getLongOptions()
    {
        return $this->longOptions;
    }

    /**
     * @return array
     */
    public function getShortOptions()
    {
        return $this->shortOptions;
    }

    public function addArgument(InputArgument $argument)
    {

    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}