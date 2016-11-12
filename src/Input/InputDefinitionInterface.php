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
 * Interface InputDefinitionInterface
 *
 * @package FastD\Console\Input
 */
interface InputDefinitionInterface
{
    /**
     * @param InputOption $inputOption
     * @return InputDefinitionInterface
     */
    public function setOption(InputOption $inputOption);

    /**
     * @param $name
     * @return InputOption
     */
    public function getOption($name);

    /**
     * @param InputArgument $inputArgument
     * @return InputDefinitionInterface
     */
    public function setArgument(InputArgument $inputArgument);

    /**
     * @param $name
     * @return InputArgument
     */
    public function getArgument($name);

    /**
     * @return InputOption[]
     */
    public function getDefaultInputOptions();

    /**
     * @return InputArgument[]
     */
    public function getDefaultInputArguments();
}