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
 * Command Interface
 *
 * Interface CommandInterface
 *
 * @package Dobee\Console
 */
interface CommandInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
//    public function getDescription();

    /**
     * @param        $key
     * @param        $value
     * @param string $optional
     * @param string   $notice
     * @return CommandInterface
     */
    public function addOption($key, $value, $optional = Argument::OPTIONAL, $notice = null);

    /**
     * @param null $key
     * @return array
     */
    public function getOption($key = null);

    /**
     * @return mixed
     */
    public function configure();

    /**
     * @return string
     */
    public function help();

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return mixed|void
     */
    public function execute(InputInterface $input, OutputInterface $output);
}