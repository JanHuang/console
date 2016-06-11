<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/11
 * Time: 下午1:19
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Help;

use FastD\Console\Command\Command;
use FastD\Console\Input\InputArgument;
use FastD\Console\Input\InputOption;

/**
 * Class MissingHelp
 *
 * @package FastD\Console\Help
 */
class MissingHelp extends Help
{
    /**
     * MissingHelp constructor.
     *
     * @param Command $command
     * @param array $missing
     */
    public function __construct(Command $command, array $missing = array())
    {
        $helper = new UsageHelp($command);

        $help = $helper->getHelp() . PHP_EOL . PHP_EOL;

        $missingOptions = [];
        $missingArguments = [];

        foreach ($missing as $value) {
            if ($value instanceof InputOption) {
                $missingOptions[] = '[--' . $value->getName() . '|-' . str_replace('|', '|-', $value->getShortcut()) . ']';
            } else if ($value instanceof InputArgument) {
                $missingArguments[] = '[<' . $value->getName() . '>]';
            }
        }

        $help .= <<<EOF
Command <info>"%s"</info> missing 
EOF;

        if (!empty($missingArguments)) {
            $help .= sprintf('arguments: <notice>%s</notice>', implode(' ', $missingArguments)) . ' ';
        }

        if (!empty($missingOptions)) {
            $help .= sprintf('options: <notice>%s</notice>', implode(' ', $missingOptions)) . ' ';
        }

        parent::__construct(sprintf($help, $command->getName()));
    }
}