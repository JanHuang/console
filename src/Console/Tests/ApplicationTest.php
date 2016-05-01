<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/11
 * Time: 上午1:04
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Tests;

use FastD\Console\ArgvInput;
use FastD\Console\Environment\Application;
use FastD\Console\Tests\Command\BaseCommand;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testApplication()
    {
        $_SERVER['argv'] = [
            'demo.php',
            'test:demo',
            '-f',
            'value for f',
            '-v',
            '-a',
            '--required',
            'value',
            '--optional="optional value"',
            '--option'
        ];

        $application = new Application();
        $application->setCommand(new BaseCommand());
        $application->run(new ArgvInput());
    }
}
