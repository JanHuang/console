<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

use FastD\Console\Console;

include __DIR__ . '/vendor/autoload.php';

include_once __DIR__ . '/tests/OutputHelloCommand.php';
include_once __DIR__ . '/tests/OutputWorldCommand.php';
include_once __DIR__ . '/tests/QRCodeCommand.php';

$console = new Console();

$console->addCommand(new OutputWorldCommand());
$console->addCommand(new OutputHelloCommand());
$console->addCommand(new QRCodeCommand());

$console->run();
