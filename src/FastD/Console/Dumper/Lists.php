<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/30
 * Time: 上午11:29
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console\Dumper;

use FastD\Console\Command;
use FastD\Console\Environment\EnvironmentInterface;
use FastD\Console\IO\Input;
use FastD\Console\IO\Output;

class Lists extends Command
{
    protected $env;

    public function __construct(EnvironmentInterface $interface)
    {
        $this->env = $interface;
    }

    public function getName()
    {
        return 'command:list';
    }

    public function configure()
    {
        $this->setDescription('Command list tool.');
    }

    public function execute(Input $input, Output $output)
    {
        $output->writeln('Command name:');
        foreach ($this->env as $name => $command) {
            $output->writeln($command->getName(), Output::STYLE_SUCCESS);
        }
    }
}