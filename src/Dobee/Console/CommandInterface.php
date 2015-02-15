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

use Dobee\Console\Format\InputInterface;
use Dobee\Console\Format\OutputInterface;

interface CommandInterface
{
    public function setName($name);

    public function getName();

    public function setDescription($description);

    public function getDescription();

    public function addOption($key, $value, $notice = null);

    public function getOption($key = null);

    public function configure();

    public function execute(InputInterface $input, OutputInterface $output);
}