<?php

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class OutputHelloCommand extends \FastD\Console\Command\Command
{
    public function getName()
    {
        return 'hello';
    }

    public function configure()
    {
        // TODO: Implement configure() method.
    }

    public function execute(\FastD\Console\Input\InputInterface $input, \FastD\Console\Output\OutputInterface $output)
    {
        echo 'hello';
    }
}