<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/9
 * Time: 下午7:53
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

include __DIR__ . '/../vendor/autoload.php';

class Demo extends \Dobee\Console\Commands\Command
{
    protected $description = 'command hello';

    public function getName()
    {
        return 'demo';
    }

    public function configure()
    {
        $this->setOptions('name', null);
        $this->setOptions('age', null, \Dobee\Console\Commands\Command::ARG_REQUIRED);
        $this->setArguments('name', null);
        $this->setArguments('age', null, \Dobee\Console\Commands\Command::ARG_REQUIRED);
    }

    public function execute(\Dobee\Console\Format\Input $input, \Dobee\Console\Format\Output $output)
    {
        $output->writeBackground('hello demo ' . $this->getOptions('age')->getValue(), \Dobee\Console\Format\Output::STYLE_INFO);
    }
}

$console = new \Dobee\Console\Console(array(
    '\\Demo'
));

//$console->addCommand(new Demo());

$console->run();
