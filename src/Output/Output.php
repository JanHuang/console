<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Output;

use FastD\Console\Help\Help;

/**
 * Class Output
 *
 * @package FastD\Console\Output
 */
class Output
{
    /**
     * @param $message
     * @param bool $toReturn
     * @return string
     */
    public function write($message, $toReturn = false)
    {
        $message = OutputFormatter::format($message);

        if ($toReturn) {
            return $message;
        }

        echo $message;
    }

    /**
     * @param $message
     * @return void
     */
    public function writeln($message)
    {
        $message = $this->write($message, true);

        echo $message . PHP_EOL;
    }

    /**
     * @param Help $help
     */
    public function writeHelp(Help $help)
    {
        $this->writeln($help->getHelp());
    }
}
