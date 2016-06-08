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
 * @package FastD\Console\Format
 */
class Output implements OutputInterface
{
    protected $env = '*unix';

    public function __construct()
    {
        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            $this->env = 'win';
        }
    }

    /**
     * @param        $message
     * @param string $style
     */
    public function write($message, $style = self::STYLE_DEFAULT)
    {
        echo $this->format($message, $style);
    }

    /**
     * @param        $message
     * @param string $style
     */
    public function writeln($message, $style = self::STYLE_DEFAULT)
    {
        $this->write($message, $style);

        echo PHP_EOL;
    }

    /**
     * @param        $message
     * @param string $style
     * @return string
     */
    public function format($message, $style = self::STYLE_DEFAULT)
    {
        if ('win' === $this->env) {
            return $message;
        }

        return chr(27) . $style . $message . chr(27) . "[0m";
    }

    /**
     * @param        $message
     * @param string $style
     * @param int    $width
     * @param int    $height
     */
    public function writeBackground($message, $style = self::STYLE_DEFAULT, $width = 1, $height = 1)
    {
        for ($i = 0; $i < $height; ++$i) {
            $this->writeln(str_repeat(' ', (strlen($message) + $width * 2)), $style);
        }

        $this->writeln(str_repeat(' ', $width) . $message . str_repeat(' ', $width), $style);

        for ($i = 0; $i < $height; ++$i) {
            $this->writeln(str_repeat(' ', (strlen($message) + $width * 2)), $style);
        }
    }

    public function onException(\Exception $exception)
    {
        $height = 1;
        $width = 1;
        $file = 'File: ' . $exception->getFile() . ' Line: ' . $exception->getLine();
        $message = 'Message: ' . $exception->getMessage();

        for ($i = 0; $i < $height; ++$i) {
            $this->writeln(str_repeat(' ', (strlen($file) + $width * 2)), self::STYLE_BG_FAILURE);
        }

        $this->writeln(str_repeat(' ', $width) . $message . str_repeat(' ', ($length = strlen($file) - strlen($message)) <= 0 ? 1 : $length) . str_repeat(' ', $width), self::STYLE_BG_FAILURE);
        $this->writeln(str_repeat(' ', $width) . $file . str_repeat(' ', $width), self::STYLE_BG_FAILURE);

        for ($i = 0; $i < $height; ++$i) {
            $this->writeln(str_repeat(' ', (strlen($file) + $width * 2)), self::STYLE_BG_FAILURE);
        }
        
        $this->writeln('');
    }
}