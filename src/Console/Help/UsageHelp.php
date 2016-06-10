<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午10:45
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Help;

use FastD\Console\Command\Command;
use FastD\Console\Console;

/**
 * Class UsageHelp
 *
 * @package FastD\Console\Help
 */
class UsageHelp extends Help
{
    /**
     * UsageHelp constructor.
     *
     * @param Command|null $command
     */
    public function __construct(Command $command = null)
    {
        $help = $this->getConsoleUsageHelp();

        if (null !== $command) {
            $help = $command->getHelp();

            if (empty($help)) {
                $options = [];
                foreach ($command->getOptions() as $option) {
                    $shortcut = '';
                    if (!empty($option->getShortcut())) {
                        $shortcut = '|-' . str_replace('|', '-|', $option->getShortcut());
                    }
                    $options[] = '[--' . $option->getName() . $shortcut . ']';
                }

                $arguments = [];

                foreach ($command->getArguments() as $argument) {
                    $arguments[] = sprintf('[<%s>]', $argument->getName());
                }

                $help = <<<EOF
Usage: 
  %s %s %s

<info>Arguments:</info>
  %s
  
<info>Options:</info>
  %s
EOF;

                $help = sprintf($help,
                    $command->getName(),
                    implode(' ', $options),
                    implode(' ', $arguments),
                    implode(PHP_EOL, array_map(function ($v) use ($command) {
                        $name = str_replace(['<', '>', '[', ']'], '', $v);
                        return $name  . "\t" . '<notice>' . $command->getArgument($name)->getDescription() . '</notice>';
                    }, $arguments)),
                    implode(PHP_EOL, array_map(function ($v) use ($command) {
                        $name = str_replace(['<', '>', '[', ']'], '', $v);
                        $key = trim(explode('|', $name)[0], '-');
                        return $name  . "\t" . '<notice>' . $command->getOption($key)->getDescription() . '</notice>';
                    }, $options))
                );
            }
        }

        parent::__construct($help);
    }

    /**
     * @return string
     */
    public function getConsoleUsageHelp()
    {
        $version = Console::VERSION;

        return <<<EOF
Console Tool: <success>{$version}</success>
        
<info>Usage</info>:
  help [options] [--] [<command_name>]

<info>Arguments</info>:
  command               The command to execute

<info>Options</info>:
  -h, --help            Display this help message
  -d, --debug           Display console debug message.

<info>Help</info>:
 The help command displays help for a given command:

   <notice>php demo.php help list</notice>

 You can also output the help in other formats by using the --debug option:

   <notice>php demo.php help --debug</notice>

 To display the list of available commands, please use the list command.
EOF;
    }
}