# Console

简单的 PHP 命令行工具

## 要求

* PHP 7+

## Composer

```json
{
    "fastd/console": "2.0.x-dev"
}
```

## 使用

```php
use FastD\Console\Environment\Application;
use FastD\Console\ArgvInput;

$argvInput = new ArgvInput();
$application = new Application();
$application->setCommand(new \FastD\Console\Tests\Command\BaseCommand());
$application->setCommand(new \FastD\Console\Tests\Command\TestCommand());
$application->run($argvInput);
```

命令行执行 `php examples/demo.php`, 显示所有注册的命令，输入具体命令名称则执行具体命令逻辑操作

例如:

`php examples/demo.php base:demo`

## License MIT

