<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/29
 * Time: 下午10:40
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console;

use FastD\Console\Environment\EnvironmentInterface;

interface InvokerInterface
{
    public function __construct(EnvironmentInterface $provider);

    public function run(ArgvInput $argvInput);
}