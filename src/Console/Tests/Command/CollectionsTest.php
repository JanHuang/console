<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/6/9
 * Time: 上午11:20
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 */

namespace FastD\Console\Tests\Command;

use FastD\Console\Command\Collections;
use FastD\Console\Command\HelpCommand;
use FastD\Console\Command\ListCommand;

class CollectionsTest extends \PHPUnit_Framework_TestCase
{
    protected $definition = [];

    public function setUp()
    {
        $this->definition = [
            'help' => new HelpCommand(),
            'list' => new ListCommand()
        ];
    }

    public function testCollections()
    {
        $collection = new Collections();

        $this->assertEquals(
            $collection->getCommands(),
            $this->definition
        );

        $collection->addCommand(new BaseCommand());

        $this->definition['test:demo'] = new BaseCommand();

        $this->assertEquals(
            $collection->getCommands(),
            $this->definition
        );
    }
}
