<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

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
        return [
            new UsageCommand(),
        ];
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $name = $this->input->getFirstArgument();

        if (!$this->hasCommand($name)) {
            $this->output->writeln('Usage', '', '');
            return 1;
        }

        $this->command = $this->getCommand($name);

        if ($this->input->hasOption(['v', 'vv', 'vvv', 'debug'])) {
            $this->enableDebug();
        }

        if ($this->input->hasOption(['h', 'help'])) {
            $this->output->writeln('Command', '', '');
            return 0;
        }

        return $this->command->execute($this->input, $this->output);
    }
}