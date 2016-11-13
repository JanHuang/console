<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Command;

use FastD\Console\Input\InputArgument;
use FastD\Console\Input\InputInterface;
use FastD\Console\Input\InputOption;
use FastD\Console\Output\OutputInterface;

/**
 * Interface CommandInterface
 *
 * @package FastD\Console
 */
interface CommandInterface
{
    /**
     * @param $name
     * @param int $optional
     * @param string $description
     * @param null $default
     * @return mixed
     */
    public function setArgument($name, $optional = InputArgument::OPTIONAL, $description = '', $default = null);

    /**
     * @param $name
     * @return InputArgument
     */
    public function getArgument($name);

    /**
     * @return InputArgument[]
     */
    public function getArguments();

    /**
     * @param $name
     * @param null $shortcut
     * @param int $optional
     * @param string $description
     * @param null $default
     * @return mixed
     */
    public function setOption($name, $shortcut = null, $optional = InputOption::VALUE_OPTIONAL, $description = '', $default = null);

    /**
     * @param $name
     * @return InputOption
     */
    public function getOption($name);

    /**
     * @return InputOption[]
     */
    public function getOptions();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return mixed
     */
    public function configure();

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function execute(InputInterface $input, OutputInterface $output);
}