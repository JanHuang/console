<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/10
 * Time: 下午12:36
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

include __DIR__ . '/../vendor/autoload.php';

use FastD\Console\Environment\Application;
use FastD\Console\ArgvInput;

$argvInput = new ArgvInput();
$application = new Application();
$application->setCommand(new \FastD\Console\Tests\Command\BaseCommand());
$application->setCommand(new \FastD\Console\Tests\Command\TestCommand());
$application->run($argvInput);

