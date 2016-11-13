<?php

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class ArgumentCommand extends \FastD\Console\Command
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'foo';
    }

    /**
     * @return void
     */
    public function configure()
    {
        $this->setOption('foo');
        $this->setArgument('bar');
    }

    public function execute(\FastD\Console\Input\InputInterface $input, \FastD\Console\Output\OutputInterface $output)
    {
        // TODO: Implement execute() method.
    }
}