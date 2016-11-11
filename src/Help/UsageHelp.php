<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
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
<info>Usage:</info> 
  %s %s %s
  
%s

%s
EOF;
            $argString = '';
            if (!empty($arguments)) {
                $argString .= sprintf('<info>Arguments:</info> %s', PHP_EOL . implode(PHP_EOL, array_map(function ($v) use ($command) {
                    $name = str_replace(['<', '>', '[', ']'], '', $v);
                    return '  ' . $name . "\t" . '<notice>' . $command->getArgument($name)->getDescription() . '</notice>';
                }, $arguments)));
            }

            $optString = '';
            if (!empty($options)) {
                $optString .= sprintf('<info>Options:</info> %s', PHP_EOL . implode(PHP_EOL, array_map(function ($v) use ($command) {
                        $name = str_replace(['<', '>', '[', ']'], '', $v);
                        $key = trim(explode('|', $name)[0], '-');
                        return '  ' . $name . "\t" . '<notice>' . $command->getOption($key)->getDescription() . '</notice>';
                    }, $options)));
            }

            $help = sprintf($help,
                $command->getName(),
                implode(' ', $options),
                implode(' ', $arguments),
                $argString,
                $optString
            );
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