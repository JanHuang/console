<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:50
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Format;

use Dobee\Console\Argument\ArgumentInterface;

class Input implements InputInterface
{
    const REQUIRED = ':';

    const OPTIONAL = '::';

    const VALUE_NONE = '';

    private $options = array();

    private $arguments = array();

    public function __construct(ArgumentInterface $argumentInterface)
    {
        $this->arguments = $argumentInterface;
    }

    public function getCommandName()
    {
        return $this->arguments->getCommandName();
    }

    public function addOption($key, $value = null, $optional = Input::OPTIONAL, $notice = null)
    {
        $this->options[$key] = array(
            'value' => $value,
            'optional' => $optional,
            'notice' => $notice,
        );

        return $this;
    }

    public function hasOption($key)
    {
        return isset($this->options[$key]);
    }

    public function parseArgsInput()
    {
        return $this->arguments->parse($this->options);
    }

    public function getArgument($key)
    {
        return $this->arguments->getArgument($key);
    }

    public function getOption($key)
    {
        if (!$this->hasOption($key)) {
            return false;
        }

        return $this->options[$key];
    }
}