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

/**
 * Class Input
 *
 * @package FastD\Console\Input
 */
class Input
{
    /**
     * @var InputDefinition
     */
    protected $definition;

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
    protected $options = [];

    /**
     * 短选项 "-o"
     *
     * @var array
     */
    protected $shortcuts = [];

    /**
     * @var array
     */
    protected $arguments = [];

    /**
     * Input constructor.
     *
     * @param array|null $argv
     * @param InputDefinition|null $inputDefinition
     */
    public function __construct(array $argv = null, InputDefinition $inputDefinition = null)
    {
        $this->argv = null === $argv ? $_SERVER['argv'] : $argv;

        array_shift($this->argv);

        if (null === $inputDefinition) {
            $inputDefinition = new InputDefinition();
        }

        if (null !== $inputDefinition) {
            $this->bind($inputDefinition);
        }

        $this->parse($this->argv);
    }

    /**
     * @param InputDefinition $definition
     */
    public function bind(InputDefinition $definition)
    {
        $this->definition = $definition;
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
     * @return mixed|null
     */
    public function getFirstArgument()
    {
        return $this->arguments[0] ?? null;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function getArgument($name)
    {

    }

    public function getOptions()
    {
        return array_merge($this->longOptions, $this->shortOptions);
    }

    public function getOption($name)
    {

    }

    /**
     * @param $name
     * @return bool|null
     */
    public function hasOption($name)
    {

    }
}