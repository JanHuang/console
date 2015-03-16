<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/3/16
 * Time: 下午3:54
 * Github: https://www.github.com/janhuang 
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 */

namespace Dobee\Console\Commands;

/**
 * Class Argument
 *
 * @package Dobee\Console\Commands
 */
class Argument
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $optional;

    /**
     * @var string
     */
    protected $description;

    /**
     * @param $name
     * @param $value
     * @param $optional
     * @param $description
     */
    public function __construct($name, $value, $optional, $description)
    {
        $this->name = $name;

        $this->value = $value;

        $this->optional = $optional;

        $this->description = $description;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * @param mixed $optional
     * @return $this
     */
    public function setOptional($optional)
    {
        $this->optional = $optional;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @param $optional
     * @param $description
     * @return Argument
     */
    public static function createArgument($name, $value, $optional, $description)
    {
        return new self($name, $value, $optional, $description);
    }
}