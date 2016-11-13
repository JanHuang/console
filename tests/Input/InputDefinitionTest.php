<?php

/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class InputDefinitionTest extends PHPUnit_Framework_TestCase
{
    public function testDefinitionBindCommand()
    {
        include_once __DIR__ . '/ArgumentCommand.php';

        $definition = new \FastD\Console\Input\InputDefinition();

        $definition->bindCommand(new ArgumentCommand());

        $this->assertCount(4, $definition->getOptions());
        $this->assertCount(2, $definition->getArguments());
    }
}
