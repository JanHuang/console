<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/2/15
 * Time: 上午12:33
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console;

use Dobee\Console\Format\Input;
use Dobee\Console\Format\InputInterface;
use Dobee\Console\Format\OutputInterface;

abstract class Command implements CommandInterface
{
    private $description;

    private $options;

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function addOption($key, $value = null, $optional = Input::OPTIONAL, $notice = null)
    {
        $this->options[$key] = array(
            'name' => $key,
            'value' => $value,
            'optional' => $optional,
            'notice' => $notice,
        );

        return $this;
    }

    public function getOption($key = null)
    {
        if (null === $key) {
            return $this->options;
        }

        return $this->options[$key];
    }

    abstract public function getName();

    abstract public function configure();

    abstract public function execute(InputInterface $input, OutputInterface $output);
}