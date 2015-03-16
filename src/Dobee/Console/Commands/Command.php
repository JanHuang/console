<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/9
 * Time: 下午7:44
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Commands;

use Dobee\Console\Format\Input;
use Dobee\Console\Format\Output;

/**
 * Class Command
 *
 * @package Dobee\Console\Commands
 */
abstract class Command
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var string
     */
    protected $description;

    /**
     * @var CommandCollections
     */
    protected $collections;

    /**
     * @const string
     */
    const ARG_REQUIRED = ':';

    /**
     * @const string
     */
    const ARG_OPTIONAL = '::';

    /**
     * @const string
     */
    const ARG_NOT = '';

    /**
     * @var array
     */
    protected $arguments = array();

    /**
     * @var Input
     */
    protected $input;

    /**
     * @var Output
     */
    protected $output;

    /**
     * @param Input  $input
     * @param Output $output
     */
    public function __construct(Input $input = null, Output $output = null)
    {
        $this->input = $input;

        $this->output = $output;
    }

    /**
     * @return Input
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @return Output
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param Input $input
     * @return $this
     */
    public function setInput(Input $input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * @param Output $output
     * @return $this
     */
    public function setOutput(Output $output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return void|$this
     */
    abstract public function configure();

    /**
     * @param Input  $input
     * @param Output $output
     * @return void
     */
    abstract public function execute(Input $input, Output $output);

    /**
     * @param CommandCollections $collections
     * @return $this
     */
    public function setCollections(CommandCollections $collections)
    {
        $this->collections = $collections;

        return $this;
    }

    /**
     * @return CommandCollections
     */
    public function getCollection()
    {
        return $this->collections;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param        $name
     * @param        $value
     * @param string $optional
     * @param string $description
     * @return $this
     */
    public function setArguments($name, $value = null, $optional = self::ARG_OPTIONAL, $description = '')
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                if ($value instanceof Argument) {
                    $this->arguments[$key] = $value;
                }
            }

            return $this;
        }

        if ($value instanceof Argument) {
            $this->arguments[$name] = $value;
        }

        $this->arguments[$name] = Argument::createArgument($name, $value, $optional, $description);

        return $this;
    }

    /**
     * @param null $name
     * @return Argument|Argument[]
     */
    public function getArguments($name = null)
    {
        if (null === $name) {
            return $this->arguments;
        }

        return $this->arguments[$name];
    }

    /**
     * @param        $name
     * @param        $value
     * @param string $optional
     * @param string $description
     * @return $this
     */
    public function setOptions($name, $value = null, $optional = self::ARG_OPTIONAL, $description = '')
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                if ($value instanceof Option) {
                    $this->options[$key] = $value;
                }
            }

            return $this;
        }

        if ($value instanceof Argument) {
            $this->options[$name] = $value;
        }

        $this->options[$name] = Option::createOption($name, $value, $optional, $description);

        return $this;
    }

    /**
     * @param null $name
     * @return Option|Option[]
     */
    public function getOptions($name = null)
    {
        if (null === $name) {
            return $this->options;
        }

        return $this->options[$name];
    }

    /**
     * @param $command
     * @return Command
     */
    public function getCommand($command)
    {
        return $this->collections->getCommand($command);
    }

    /**
     * @param $command
     */
    public function executeCommand($command)
    {
        $this->collections->executeCommand($command, $this->input, $this->output);
    }

    public function writeDescription()
    {
        $this->output->writeln(str_repeat(' ', strlen($this->getDescription()) + 4), Output::STYLE_BG_NOTICE);
        $this->output->writeln('  ' . $this->getDescription() . '  ', Output::STYLE_BG_NOTICE);
        $this->output->writeln(str_repeat(' ', strlen($this->getDescription()) + 4), Output::STYLE_BG_NOTICE);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        if (null === $this->path) {
            $this->path = dirname((new \ReflectionClass($this))->getFileName());
        }

        return $this->path;
    }
}