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

use Dobee\Console\Options\Options;

class Input implements InputInterface
{
    const REQUIRED = ':';

    const OPTIONAL = '::';

    const VALUE_NONE = '';

    const OPTION_SHORT = 4;

    const OPTION_LONG = 5;

    private $options = array();

    private $arguments = array();

    public function addOption($key, $value = null, $options = Input::OPTIONAL, $notice = null)
    {
        $this->arguments[$key] = array(
            'value' => $value,
            'optional' => $options,
            'notice' => $notice,
        );

        $this->options[] = $key . $options;
    }

    public function hasOption($key)
    {
        return isset($this->options[$key]);
    }

    public function parseArgsInput()
    {
        $this->arguments = Options::parse('', $this->options);

        return $this->arguments;
    }

    public function removeOption($key)
    {
        if ($this->hasOption($key)) {
            unset($this->options[$key]);
        }

        return $this;
    }

    public function hasArgument($key)
    {
        return isset($this->arguments[$key]);
    }

    public function setArgument($key, $value)
    {
        $this->arguments[$key] = $value;

        return $this;
    }

    public function getArgument($key)
    {
        if (!isset($this->arguments[$key])) {
            throw new \Exception(sprintf('%s\' is undefined.', $key));
        }

        return $this->arguments[$key];
    }

    public function getNotice($key)
    {
        return STDIN;
    }
}