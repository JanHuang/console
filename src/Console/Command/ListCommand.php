<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午11:00
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Command;

use FastD\Console\Console;
use FastD\Console\Input\Input;
use FastD\Console\Output\Output;

class ListCommand extends Command
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'list';
    }

    /**
     * @return void
     */
    public function configure()
    {
        // TODO: Implement configure() method.
    }

    /**
     * @param Input $input
     * @param Output $output
     * @return int
     */
    public function execute(Input $input, Output $output)
    {
        $output->writeln('Console Tool <success>' . Console::VERSION . '</success>' . PHP_EOL);

        $outputed = [];

        foreach ($this->getCollections() as $command) {
            if (false !== $index = strpos($command->getName(), ':')) {
                $name = substr($command->getName(), 0, $index);
                if (!isset($outputed[$name])) {
                    $output->writeln(sprintf('<info>%s</info>', $name));
                    $outputed[$name] = true;
                }
            }
            $output->writeln(sprintf('  %s %s', $command->getName(), $command->getHelp()));
        }
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        return '获取命令列表';
    }
}