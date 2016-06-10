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

use FastD\Console\Console;

class UsageHelp extends Help
{
    /**
     * @return string
     */
    public function getHelp()
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