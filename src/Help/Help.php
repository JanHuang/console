<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Help;

/**
 * Class Help
 *
 * @package FastD\Console\Help
 */
abstract class Help
{
    /**
     * @var string
     */
    protected $help;

    /**
     * Help constructor.
     *
     * @param string $help
     */
    public function __construct($help = '')
    {
        $this->help = $help;
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        return $this->help;
    }
}