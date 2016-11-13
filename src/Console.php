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
use FastD\Console\Input\Input;
use FastD\Console\Input\InputInterface;
use FastD\Console\Output\ConsoleOutput;
use FastD\Console\Output\Output;
use FastD\Console\Output\OutputInterface;
use RuntimeException;

/**
 * Class Console
 *
 * @package FastD\Console
 */
class Console extends Collections implements ConsoleInterface
{
    const VERSION = 'v3.0.0-dev';
    
    /**
     * @var Command
     */
    protected $command;

    protected $input;

    /**
     * @var Output
     */
    protected $output;

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

    public function run()
    {
        $name = $this->input->getFirstArgument();

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

    public function execute()
    {
        return $this->command->execute($this->input, $this->output);
    }

    /**
     * @return Command
     */
    public function getDefaultCommand()
    {
        return new ListCommand();
    }
}