<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Command\Command;
use FastD\Console\Command\CommandInterface;
use FastD\Console\Input\Input;
use FastD\Console\Input\InputDefinition;
use FastD\Console\Input\InputDefinitionInterface;
use FastD\Console\Input\InputInterface;
use FastD\Console\Output\Output;
use FastD\Console\Output\OutputInterface;

/**
 * Class Console
 *
 * @package FastD\Console
 */
class Console implements ConsoleInterface
{
    const VERSION = 'v3.0.0-dev';

    /**
     * @var CommandInterface
     */
    protected $command;

    /**
     * @var Command[]
     */
    protected $commands = [];

    /**
     * @var Input|InputInterface
     */
    protected $input;

    /**
     * @var Output
     */
    protected $output;

    /**
     * @var bool
     */
    protected $debug = false;

    /**
     * Console constructor.
     *
     * @param InputInterface|null $input
     * @param OutputInterface|null $output
     */
    public function __construct(InputInterface $input = null, OutputInterface $output = null)
    {
        foreach ($this->getDefaultCommands() as $command) {
            $this->addCommand($command);
        }

        $this->configureIO($input, $output);
    }

    /**
     * @param InputInterface|null $input
     * @param OutputInterface|null $output
     * @return $this
     */
    public function configureIO(InputInterface $input = null, OutputInterface $output = null)
    {
        if (null === $input) {
            $input = new Input(null, $this->getDefaultDefinition());
        }

        if (null === $output) {
            $output = new Output();
        }

        $this->input = $input;
        $this->output = $output;

        return $this;
    }

    /**
     * @return $this
     */
    public function enableDebug()
    {
        $this->debug = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param CommandInterface $command
     * @return $this
     */
    public function addCommand(CommandInterface $command)
    {
        $this->commands[$command->getName()] = $command;

        return $this;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasCommand($name)
    {
        return isset($this->commands[$name]);
    }

    /**
     * @param $name
     * @return CommandInterface|bool
     */
    public function getCommand($name)
    {
        return $this->hasCommand($name) ? $this->commands[$name] : false;
    }

    /**
     * @return InputDefinitionInterface
     */
    public function getDefaultDefinition()
    {
        return new InputDefinition();
    }

    /**
     * @return CommandInterface[]
     */
    public function getDefaultCommands()
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function showUsage()
    {
        $version = Console::VERSION;

        $usage = <<<EOF
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

   <notice>php cli.php help list</notice>

 You can also output the help in other formats by using the --debug option:

   <notice>php cli.php help --debug</notice>
   
 Example:

   <notice>php cli.php hello</notice>

 To display the list of available commands, please use the list command.

<info>Available commands</info>:
EOF;
        $this->output->writeln($usage);

        return 0;
    }

    /**
     * @param CommandInterface $command
     * @return int
     */
    public function showCommand(CommandInterface $command)
    {
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

        $this->output->writeln($help);

        return 0;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findActiveCommand($name)
    {
        $list = [];

        if (false !== $index = strpos($name, ':')) {
            $name = substr($name, 0, $index);
        }

        foreach ($this->commands as $command) {
            $list[] = $command->getName();
            if (false !== strpos($command->getName(), $name)) {
                $like[] = $command->getName();
            }
        }

        $help = <<<EOF
Command "%s" is not found.
EOF;

        if (!empty($like)) {
            $help .= PHP_EOL . 'Did you mean this?' . PHP_EOL;
            $help .= '    <info>' . implode('    ' . PHP_EOL, $like) . '</info>';
        } else {
            $help .= PHP_EOL . 'You can: ' . PHP_EOL . '    <info>' . implode(PHP_EOL . '    ', $list) . '</info>';
        }

        $this->output->writeln(sprintf($help, $name));

        return 0;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $name = $this->input->getFirstArgument();

        if (empty($name)) {
            return $this->showUsage();
        }

        if (!$this->hasCommand($name)) {
            return $this->findActiveCommand($name);
        }

        $this->command = $this->getCommand($name);

        $this->input->bindCommand($this->command);

        if ($this->input->hasOption(['v', 'vv', 'vvv', 'debug'])) {
            $this->enableDebug();
        }

        if ($this->input->hasOption(['h', 'help'])) {
            return $this->showCommand($this->command);
        }

        return $this->command->execute($this->input, $this->output);
    }
}