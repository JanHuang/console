<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console;

use FastD\Console\Help\MeanHelp;
use FastD\Console\Help\MissingHelp;
use FastD\Console\Help\UsageHelp;
use FastD\Console\Input\ArgvInput;
use FastD\Console\Input\InputArgument;
use FastD\Console\Input\InputOption;
use FastD\Console\Output\ConsoleOutput;
use FastD\Console\Output\Output;
use FastD\Console\Command\Command;
use FastD\Console\Command\ListCommand;
use RuntimeException;

/**
 * Class Console
 *
 * @package FastD\Console
 */
class Console extends Collections implements ConsoleInterface, InvokerInterface
{
    const VERSION = 'v3.0.0-dev';
    
    /**
     * @var Command
     */
    protected $command;

    /**
     * @var Output
     */
    protected $output;

    /**
     * Console constructor.
     */
    public function __construct()
    {
        $this->output = new ConsoleOutput();

        foreach ($this->getDefaultCommands() as $command) {
            if ('' != $command->getName()) {
                $this->addCommand($command);
            }
        }
    }
    
    /**
     * @param ArgvInput $input
     * @return int
     */
    public function run(ArgvInput $input)
    {
        $name = $input->getCommandName();

        $name = empty($name) ? $this->getDefaultCommandName() : $name;

        if (empty($name)) {
            $this->output->writeHelp(new UsageHelp());
            return 0;
        }

        try {
            $this->command = $this->getCommand($name);
            if (null === $this->command) {
                // Not command setting.
                throw new RuntimeException(null);
            }
        } catch (RuntimeException $e) {
            $this->output->writeHelp(new MeanHelp($name, $this));
            return 0;
        }

        $this->command->configure();

        $missing = $input->bindCommand($this, $this->command);

        if ($input->hasOption('help')) {
            $this->output->writeHelp(new UsageHelp($this->command));
            return 0;
        }

        if (count($missing) > 0) {
            $this->output->writeHelp(new MissingHelp($this->command, $missing));
            return 0;
        }

        return $this->execute($input, $this->output);
    }

    /**
     * @param ArgvInput $input
     * @param ConsoleOutput $output
     * @return int
     */
    public function execute(ArgvInput $input, ConsoleOutput $output)
    {
        $return = $this->command->execute($input, $output);

        $input->resetCommand();

        return $return;
    }

    /**
     * @return Command[]
     */
    public function getDefaultCommands()
    {
        return [
            new ListCommand(),
        ];
    }

    /**
     * @return null
     */
    public function getDefaultCommandName()
    {
        return null;
    }

    /**
     * @return InputOption[]
     */
    public function getDefaultInputOptions()
    {}

    /**
     * @return InputArgument[]
     */
    public function getDefaultInputArguments()
    {}
}