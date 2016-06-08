<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/16
 * Time: 下午2:09
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace FastD\Console\Output;

/**
 * Class Output
 * 
 * @package FastD\Console\Output
 */
class Output
{
    /**
     * @var string
     */
    protected $env = '*unix';

    /**
     * Output constructor.
     */
    public function __construct()
    {
        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            $this->env = 'win';
        }
    }

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
}