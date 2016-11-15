<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Console\Style;

/**
 * Class Style
 *
 * @package FastD\Console\Style
 */
class Style implements StyleInterface
{
    /**
     * @var array
     */
    protected $colors = [];

    /**
     * Style constructor.
     */
    public function __construct()
    {
        $this->setColor('white', new Color('white'));
        $this->setColor('green', new Color('green'));
        $this->setColor('black', new Color('black'));
        $this->setColor('blue', new Color('blue'));
        $this->setColor('cyan', new Color('cyan'));
        $this->setColor('gray', new Color('gray'));
        $this->setColor('red', new Color('red'));
        $this->setColor('yellow', new Color('yellow'));
        $this->setColor('magenta', new Color('magenta'));
        $this->setColor('success', new Color('white', 'green'));
        $this->setColor('error', new Color('white', 'red'));
        $this->setColor('info', new Color('white', 'blue'));
    }

    /**
     * @param $name
     * @param ColorInterface $color
     * @return $this
     */
    public function setColor($name, ColorInterface $color)
    {
        $this->colors[$name] = $color;

        return $this;
    }

    /**
     * @param $name
     * @return Color|bool
     */
    public function getColor($name)
    {
        return isset($this->colors[$name]) ? $this->colors[$name] : false;
    }

    /**
     * @param $message
     * @return mixed|string
     */
    public function format($message)
    {
        $message = (string) $message;
        $offset = 0;
        $output = '';
        $tagRegex = '[a-z][a-z0-9_=;-]*+';
        preg_match_all("#<(($tagRegex) | /($tagRegex)?)>#ix", $message, $matches, PREG_OFFSET_CAPTURE);
        foreach ($matches[0] as $i => $match) {
            $pos = $match[1];
            $text = $match[0];
            if (0 != $pos && '\\' == $message[$pos - 1]) {
                continue;
            }

            // open tag.
            if ('/' != $text[1]) {
                $tag = $matches[1][$i][0];
            } else {
                $tag = isset($matches[3][$i][0]) ? $matches[3][$i][0] : '';
            }

            $content = substr($message, $offset, $pos - $offset);
            $output .= false !== ($color = $this->getColor($tag)) ? $color->render($content) : $content;
            $offset = $pos + strlen($text);
            unset($color);
        }

        $output .= substr($message, $offset);

        if (false !== strpos($output, '<<')) {
            return strtr($output, array('\\<' => '<', '<<' => '\\'));
        }

        return str_replace('\\<', '<', $output);
    }
}