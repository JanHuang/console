<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午10:42
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Input;

/**
 * Class InputArgument
 *
 * @package FastD\Console\Input
 */
class InputArgument
{
    const REQUIRED = 1;
    const OPTIONAL = 2;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var int
     */
    protected $optional;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var null
     */
    protected $default;

    /**
     * InputArgument constructor.
     *
     * @param $name
     * @param int $optional
     * @param string $description
     * @param null $default
     */
    public function __construct($name, $optional = InputArgument::OPTIONAL, $description = '', $default = null)
    {
        $this->name = $name;

        $this->optional = $optional;

        $this->description = $description;

        $this->default = $default;

        if (null !== $default) {
            $this->setValue($default);
        }
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->getOptional() === static::REQUIRED;
    }

    /**
     * @return bool
     */
    public function isOptional()
    {
        return $this->getOptional() === static::OPTIONAL;
    }
}