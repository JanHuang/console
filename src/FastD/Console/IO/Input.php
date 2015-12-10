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

use FastD\Console\Command\Command;

/**
 * Class Input
 *
 * @package FastD\Console\IO
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
     * Constructor
     */
    public function __construct()
    {
        $this->argv = $_SERVER['argv'];

        array_shift($this->argv);

        $this->parseCommandLineArguments();
    }

    /**
     * Initialize command argv input.
     * @return void
     */
    public function parseCommandLineArguments()
    {
        foreach ($this->argv as $argv) {
            if ('-' === substr($argv, 0, 1)) {
                $name = $argv;
                $value = null;
                if (false !== strpos($argv, '=')) {
                    list($name, $value) = explode('=', $argv);
                }
                $this->options[str_replace(['-', '--'], '', $name)] = str_replace(['"', '\''], '', $value);
            } else {
                $this->arguments[] = $argv;
            }
        }
    }

    /**
     * Recombination command line arguments.
     *
     * @param Command $command
     * @return void
     */
    public function recombination(Command $command)
    {
        $options = [];
        foreach ($command->getOption(null) as $name => $option) {
            if (!array_key_exists($name, $this->options)) {
                continue;
            }

            $options[$name] = self::ARG_NONE === $option ? null : $this->options[$name];
        }
        $this->options = $options;

        $this->arguments = array_combine(array_keys($command->getArgument(null)), array_slice($this->arguments, 0, count($command->getArgument())));
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        $has = function ($name) {
            if (array_key_exists($name, $this->options)) {
                return true;
            }
            if (array_key_exists($name, $this->arguments)) {
                return true;
            }
            throw new \Exception(sprintf('Argument "%s" is undefined.', $name));
        };
        if (is_array($name)) {
            foreach ($name as $value) {
                try {
                    return $has($value);
                } catch (\Exception $e) {
                    continue;
                }
            }
            return false;
        }

        try {
            return $has($name);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $name
     * @return null
     * @throws \Exception
     */
    public function get($name)
    {
        $get = function ($name) {
            if (array_key_exists($name, $this->options)) {
                return $this->options[$name];
            }
            if (array_key_exists($name, $this->arguments)) {
                return $this->arguments[$name];
            }
            throw new \Exception(sprintf('Argument "%s" is undefined.', $name));
        };

        if (is_array($name)) {
            foreach ($name as $value) {
                try {
                    return $get($value);
                } catch (\Exception $e) {
                    continue;
                }
            }
            return null;
        }

        try {
            return $get($name);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return array
     */
    public function getArgv()
    {
        return $this->argv;
    }
}