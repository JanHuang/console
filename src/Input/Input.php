<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Input;

/**
 * Class Input
 *
 * @package FastD\Console\Input
 */
class Input implements InputInterface
{
    /**
     * Server argv.
     *
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
     * Input constructor.
     *
     * @param array|null $argv
     */
    public function __construct(array $argv = null)
    {
        $this->argv = null === $argv ? $_SERVER['argv'] : $argv;

        array_shift($this->argv);

        $this->parse();
    }

    public function parse()
    {
        $argv = $this->argv;

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
            $key = substr($option, 2);
            $value = null;
        } else {
            list($key, $value) = explode('=', $option);
            $key = substr($key, 2);
            $value = trim($value, '\'"');
        }

        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @param $option
     * @return $this
     */
    protected function parseShortOptions($option)
    {
        if (false === ($index = strpos($option, '='))) {
            if (2 == strlen($option)) {
                $key = substr($option, 1);
                $value = null;
            } else {
                $key = substr($option, 1, 1);
                $value = substr($option, 2);
            }
        } else {
            list($key, $value) = explode('=', $option);
            $key = substr($key, 1);
            $value = trim($value, '\'"');
        }

        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getFirstArgument()
    {
        return isset($this->arguments[0]) ? $this->arguments[0] : false;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getArgument($name)
    {
        return $this->hasArgument($name) ? $this->arguments[$name] : false;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasArgument($name)
    {
        return array_key_exists($name, $this->arguments);
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getOption($name)
    {
        if (is_string($name)) {
            $name = [$name];
        }

        foreach ($name as $item) {
            if ($this->hasOption($item)) {
                return $this->options[$item];
            }
        }

        return false;
    }

    /**
     * @param $name
     * @return bool|null
     */
    public function hasOption($name)
    {
        if (is_string($name)) {
            $name = [$name];
        }

        foreach ($name as $value) {
            if (array_key_exists($value, $this->options)) {
                return true;
            }
        }

        return false;
    }
}