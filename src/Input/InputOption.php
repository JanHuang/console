<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Input;

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
     * @var string
     */
    protected $shortcut;

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

        $this->description = $description;

        $this->default = $optional === InputOption::VALUE_NONE ? null : $default;
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
     * @return null
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return bool
     */
    public function isNone()
    {
        return $this->getOptional() === InputOption::VALUE_NONE;
    }

    /**
     * @return bool
     */
    public function isOptional()
    {
        return $this->getOptional() === InputOption::VALUE_OPTIONAL;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->getOptional() === InputOption::VALUE_REQUIRED;
    }
}