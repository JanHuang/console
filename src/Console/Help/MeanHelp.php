<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/10
 * Time: 下午6:09
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Help;

use FastD\Console\Collections;

class MeanHelp extends Help
{
    public function __construct($commandName, Collections $collections)
    {
        $like = [];
        $list = [];

        $name = $commandName;

        if (false !== $index = strpos($commandName, ':')) {
            $name = substr($commandName, 0, $index);
        }

        foreach ($collections as $command) {
            $list[] = $command->getName();
            if (false !== strpos($command->getName(), $name)) {
                $like[] = $command->getName();
            }
        }

        $mean = '';

        if (!empty($like)) {
            $mean = 'Did you mean this?' . PHP_EOL;
            $mean .= '    <info>' . implode('    ' . PHP_EOL, $like) . '</info>';
        }

        $help = <<<EOF
Command "%s" is not found.
  %s
  Or
  %s
EOF;
        parent::__construct(sprintf($help, $commandName, $mean, '  <info>' . implode(PHP_EOL . '    ', $list)) . '</info>');
    }

    public function findLikeCommand($name)
    {

    }
}