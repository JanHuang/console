<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Input\InputInterface;
use FastD\Console\Output\OutputInterface;

/**
 * Class ListCommand
 *
 * @package FastD\Console
 */
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
        $this->setDescription('get commands collections.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
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
}