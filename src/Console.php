<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Help\UsageHelp;
use FastD\Console\Input\Input;
use FastD\Console\Input\InputDefinition;
use FastD\Console\Input\InputInterface;
use FastD\Console\Output\Output;
use FastD\Console\Output\OutputInterface;
use RuntimeException;

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
     * Console constructor.
     *
     * @param InputInterface|null $input
     * @param OutputInterface|null $output
     */
    public function __construct(InputInterface $input = null, OutputInterface $output = null)
    {
        if (null === $input) {
            $input = new Input();
        }

        $this->input = $input;

        if (null === $output) {
            $output = new Output();
        }

        $this->output = $output;
    }

    /**
     * @param array $commands
     * @return $this
     */
    public function setCommand(array $commands = [])
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }

        return $this;
    }

    /**
     * @param Command $command
     * @return $this
     */
    public function addCommand(Command $command)
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
     * @return mixed|null
     */
    public function getCommand($name)
    {
        return $this->hasCommand($name) ? $this->commands[$name] : false;
    }

    /**
     * @return int
     */
    public function run()
    {
        $name = $this->input->getFirstArgument();

        if (empty($name)) {
            $this->output->writeHelp(new UsageHelp());
            return 0;
        }

        try {
            $this->command = $this->getCommand($name);
            if (false === $this->command) {
                // Not command do something.
                throw new RuntimeException(null);
            }
        } catch (RuntimeException $e) {
            echo '';
            return 0;
        }

        if ($this->input->hasOption(['h', 'help'])) {
            $this->output->writeHelp(new UsageHelp($this->command));
            return 0;
        }

        return $this->command->execute($this->input, $this->output);
    }

    /**
     * @return Command
     */
    public function getDefaultCommand()
    {
        return new ListCommand();
    }

    /**
     * @return InputDefinition
     */
    public function getDefaultDefinition()
    {
        return new InputDefinition();
    }
}