<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:33
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console;

use Dobee\Console\Argument\Argument;
use Dobee\Console\Format\InputInterface;
use Dobee\Console\Format\OutputInterface;

/**
 * Class Command
 *
 * @package Dobee\Console
 */
abstract class Command implements CommandInterface
{
    private $options = array();

    public function addOption($key, $value = null, $optional = Argument::OPTIONAL, $notice = null)
    {
        $this->options[$key] = array(
            'value' => $value,
            'optional' => $optional,
            'notice' => $notice,
        );

        return $this;
    }

    public function getOption($key = null)
    {
        if (null === $key) {
            return $this->options;
        }

        return $this->options[$key];
    }

    /**
     * return command help information.
     *
     * @return string
     */
    abstract public function help();

//    abstract public function getDescription();

    abstract public function getName();

    abstract public function configure();

    abstract public function execute(InputInterface $input, OutputInterface $output);
}