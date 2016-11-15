<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Style;

use InvalidArgumentException;

/**
 * Class Color
 *
 * @package FastD\Console\Style
 */
class Color implements ColorInterface
{
    protected $availableForegroundColors = [
        'black'     => ['set' => 30, 'unset' => 39],
        'red'       => ['set' => 31, 'unset' => 39],
        'green'     => ['set' => 32, 'unset' => 39],
        'yellow'    => ['set' => 33, 'unset' => 39],
        'blue'      => ['set' => 34, 'unset' => 39],
        'magenta'   => ['set' => 35, 'unset' => 39],
        'cyan'      => ['set' => 36, 'unset' => 39],
        'white'     => ['set' => 37, 'unset' => 39],
        'gray'      => ['set' => 39, 'unset' => 39],
    ];

    protected $availableBackgroundColors = [
        'black'     => ['set' => 40, 'unset' => 49],
        'red'       => ['set' => 41, 'unset' => 49],
        'green'     => ['set' => 42, 'unset' => 49],
        'yellow'    => ['set' => 43, 'unset' => 49],
        'blue'      => ['set' => 44, 'unset' => 49],
        'magenta'   => ['set' => 45, 'unset' => 49],
        'cyan'      => ['set' => 46, 'unset' => 49],
        'white'     => ['set' => 47, 'unset' => 49],
        'gray'      => ['set' => 49, 'unset' => 49],
    ];
    protected $availableOptions = [
        'bold'      => ['set' => 1, 'unset' => 22],
        'underscore'=> ['set' => 4, 'unset' => 24],
        'blink'     => ['set' => 5, 'unset' => 25],
        'reverse'   => ['set' => 7, 'unset' => 27],
        'conceal'   => ['set' => 8, 'unset' => 28],
    ];

    /**
     * @var array
     */
    protected $foreground = [];

    /**
     * @var array
     */
    protected $background = [];

    /**
     * Style constructor.
     *
     * @param string $foreground
     * @param null $background
     */
    public function __construct($foreground = 'default', $background = null)
    {
        $this->setForeground($foreground);
        $this->setBackground($background);
    }

    /**
     * Sets style foreground color.
     *
     * @param string|null $color The color name
     *
     * @throws InvalidArgumentException When the color name isn't defined
     */
    public function setForeground($color = null)
    {
        if (null === $color) {
            $this->foreground = null;

            return;
        }

        if (!isset($this->availableForegroundColors[$color])) {
            throw new InvalidArgumentException(sprintf(
                'Invalid foreground color specified: "%s". Expected one of (%s)',
                $color,
                implode(', ', array_keys($this->availableForegroundColors))
            ));
        }

        $this->foreground = $this->availableForegroundColors[$color];
    }

    /**
     * @return array
     */
    public function getForeground()
    {
        return $this->foreground;
    }

    /**
     * @return array
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Sets style background color.
     *
     * @param string|null $color The color name
     *
     * @throws InvalidArgumentException When the color name isn't defined
     */
    public function setBackground($color = null)
    {
        if (null === $color) {
            $this->background = null;

            return;
        }

        if (!isset($this->availableBackgroundColors[$color])) {
            throw new InvalidArgumentException(sprintf(
                'Invalid background color specified: "%s". Expected one of (%s)',
                $color,
                implode(', ', array_keys($this->availableBackgroundColors))
            ));
        }

        $this->background = $this->availableBackgroundColors[$color];
    }

    /**
     * @param $text
     * @return string
     */
    public function render($text)
    {
        $setCodes = [];
        $unsetCodes = [];

        if (null !== $this->foreground) {
            $setCodes[] = $this->foreground['set'];
            $unsetCodes[] = $this->foreground['unset'];
        }
        if (null !== $this->background) {
            $setCodes[] = $this->background['set'];
            $unsetCodes[] = $this->background['unset'];
        }

        if (empty($setCodes)) {
            return $text;
        }

        return sprintf("\033[%sm%s\033[%sm", implode(';', $setCodes), $text, implode(';', $unsetCodes));
    }
}