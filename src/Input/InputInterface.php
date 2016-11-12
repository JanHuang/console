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
 * Interface InputInterface
 *
 * @package FastD\Console\Input
 */
interface InputInterface
{
    /**
     * @return mixed
     */
    public function parse();

    /**
     * @param InputDefinitionInterface $inputDefinition
     * @return mixed
     */
    public function bind(InputDefinitionInterface $inputDefinition);

    /**
     * @return mixed
     */
    public function getOptions();

    /**
     * @param $name
     * @return mixed
     */
    public function getOption($name);

    /**
     * @return mixed
     */
    public function getFirstArgument();

    /**
     * @return mixed
     */
    public function getArguments();

    /**
     * @param $name
     * @return mixed
     */
    public function getArgument($name);
}