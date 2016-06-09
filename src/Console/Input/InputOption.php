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

use FastD\Console\Output\OutputFormatter;
use InvalidArgumentException;

/**
 * Class InputOption
 *
 * @package FastD\Console\Input
 */
class InputOption
{
    const VALUE_NONE = 1;
    const VALUE_REQUIRED = 2;
    const VALUE_OPTIONAL = 4;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $shortcuts;

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
     * @var mixed
     */
    protected $value;

    /**
     * InputOption constructor.
     *
     * @param $name
     * @param null $shortcut
     * @param int $optional
     * @param string $description
     * @param null $default
     * @throws InvalidArgumentException
     */
    public function __construct($name, $shortcut = null, $optional = InputOption::VALUE_OPTIONAL, $description = '', $default = null)
    {
        if (0 === strpos($name, '--')) {
            $name = substr($name, 2);
        }

        if (empty($name)) {
            throw new InvalidArgumentException('An option name cannot be empty.');
        }

        $this->name = $name;

        $this->shortcut = str_replace('-', '', $shortcut);

        $this->optional = $optional;

        $this->description = OutputFormatter::format($description);

        if (null !== $default) {
            $this->setValue($default);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null
     */
    public function getShortcut()
    {
        return $this->shortcut;
    }

    /**
     * @return int
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isNone()
    {
        return $this->optional === InputOption::VALUE_NONE;
    }

    /**
     * @return bool
     */
    public function isOptional()
    {
        return $this->optional === InputOption::VALUE_OPTIONAL;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->optional === InputOption::VALUE_REQUIRED;
    }
}