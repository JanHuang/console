<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/6/29
 * Time: 下午11:15
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Console;

use FastD\Console\Dumper\Dump;
use FastD\Console\Dumper\Lists;
use FastD\Console\Environment\EnvironmentInterface;
use FastD\Console\IO\Input;
use FastD\Console\IO\Output;

/**
 * Class Console
 *
 * @package FastD\Console
 */
class Console implements InvokerInterface
{
    /**
     * @var EnvironmentInterface
     */
    protected $environment;

    /**
     * @var Output
     */
    protected $output;

    /**
     * @var Input|ArgvInput
     */
    protected $input;

    /**
     * Inject console execute environment.
     *
     * @param EnvironmentInterface $environment
     */
    public function __construct(EnvironmentInterface $environment)
    {
        $environment->setCommand(new Dump($environment));
        $environment->setCommand(new Lists($environment));
        $environment->register();
        
        $this->environment = $environment;

        $this->output = new Output();

        set_exception_handler([$this, 'exceptionHandler']);
    }

    /**
     * @param \Exception $exception
     */
    public function exceptionHandler(\Exception $exception)
    {
        $this->output->writeln($exception->getMessage(), Output::STYLE_BG_FAILURE);
    }

    /**
     * @param ArgvInput $argvInput
     * @return int
     */
    public function run(ArgvInput $argvInput)
    {
        $this->input = $argvInput;

        if ($this->input->emptyArgv()) {
            echo $this;
            return 0;
        }

        $name = $argvInput->getCommandName();

        $command = $this->environment->getCommand($name);

        if (0 == ($command = $this->validate($command))) {
            return 0;
        }

        if ('' != ($description = $command->getDescription())) {
            $this->output->writeBackground($description, Output::STYLE_BG_SUCCESS);
        }

        $command->execute($argvInput, $this->output);

        return 0;
    }

    /**
     * @param Command $command
     * @return Command
     */
    public function validate(Command $command)
    {
        $command->configure();

        if (($this->input->emptyArgv() && array() !== $command->getAllOptions()) || $this->input->hasParameterOption(['--help', '-h'])) {
            echo $command;
            return 0;
        }

        return $command;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("Console help: \ncommand [--help] [argument] [--optional] ... \n");
    }
}