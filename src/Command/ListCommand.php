<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
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
            $output->writeln(sprintf('  %s %s', $command->getName(), $command->getDescription()));
        }
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return '获取命令列表';
    }
}