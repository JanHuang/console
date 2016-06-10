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

class UsageHelp extends Help
{
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

                echo html_entity_decode($str);
                $arguments = array_keys($command->getArguments());
                $arguments = array_map(function ($v) {
                    return (sprintf('[<%s>]', $v));
                }, $arguments);
                $help = sprintf('<info>Usage</info> <notice>%s</notice> <warning>%s %s</warning>', $command->getName(), implode(' ', $options), implode(' ', $arguments));
            }
        }

        parent::__construct($help);
    }

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