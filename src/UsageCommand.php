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
class UsageCommand extends Command
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'usage';
    }

    /**
     * @return void
     */
    public function configure()
    {
        $version = Console::VERSION;

        $description = <<<EOF
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

        $this->setDescription($description);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        echo 'list';
    }
}