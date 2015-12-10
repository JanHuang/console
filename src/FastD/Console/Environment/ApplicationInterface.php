<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/30
 * Time: 上午10:49
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Environment;

use FastD\Console\ArgvInput;
use FastD\Console\Command\Command;

/**
 * Interface EnvironmentInterface
 *
 * @package FastD\Console\Environment
 */
interface ApplicationInterface
{
    /**
     * @param ArgvInput $argvInput
     * @return mixed
     */
    public function run(ArgvInput $argvInput);

    /**
     * @param $name
     * @return Command
     */
    public function getCommand($name);

    /**
     * @param $name
     * @return bool
     */
    public function hasCommand($name);

    /**
     * @param Command $command
     * @return $this
     */
    public function setCommand(Command $command);
}