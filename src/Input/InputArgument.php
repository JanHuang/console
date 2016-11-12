<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
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
    protected $default;

    /**
     * @var int
     */
    protected $optional;

    /**
     * @var string
     */
    protected $description;

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