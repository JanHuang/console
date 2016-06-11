<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/12/11
 * Time: 上午1:01
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
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
use FastD\Console\Command\HelpCommand;
use FastD\Console\Command\ListCommand;
use RuntimeException;

/**
 * Class Console
 *
 * @package FastD\Console
 */
class Console extends Collections implements ConsoleInterface, InvokerInterface
{
    const VERSION = 'v2.0.0';
    
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
            $this->addCommand($command);
        }
    }
    
    /**
     * @param ArgvInput $input
     * @return int
     */
    public function run(ArgvInput $input)
    {
        $name = $input->getCommandName();

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