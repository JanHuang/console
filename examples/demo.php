#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:30
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

$loader = include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/HelloCommand.php';

$helloCommand = new HelloCommand();

use Dobee\Console\Console;

$console = new Console();

$console->addCommand($helloCommand);

$console->run();
