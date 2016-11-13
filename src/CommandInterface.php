<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Input\InputArgument;
use FastD\Console\Input\InputInterface;
use FastD\Console\Input\InputOption;
use FastD\Console\Output\OutputInterface;

interface CommandInterface
{
    public function setArgument($name, $optional = InputArgument::OPTIONAL, $description = '', $default = null);

    public function getArguments();

    public function setOption($name, $shortcut = null, $optional = InputOption::VALUE_OPTIONAL, $description = '', $default = null);

    public function getOptions();

    public function getName();

    public function configure();

    public function execute(InputInterface $input, OutputInterface $output);
}