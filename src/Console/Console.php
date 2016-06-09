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

use FastD\Console\Help\UsageHelp;
use FastD\Console\Input\ArgvInput;
use FastD\Console\Output\ConsoleOutput;
use FastD\Console\Output\Output;
use RuntimeException;

/**
 * Class Console
 *
 * @package FastD\Console
 */
class Console extends Collections implements ConsoleInterface, InvokerInterface
{
    use Definition;

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
        $name = $input->getCommand();

        if (null === $name) {
            $this->output->writeHelp(new UsageHelp());
            return 0;
        }

        try {
            $this->command = $this->getCommand($name);
        } catch (RuntimeException $e) {
            $this->output->writeln(sprintf('Do you has mean ["<warning>%s</warning>"]?', $name));
            return 0;
        }

        $this->command->configure();

        $input->bindCommand($this->command);

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
}