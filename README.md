# Console

![Building](https://api.travis-ci.org/JanHuang/console.svg?branch=master)
[![Latest Stable Version](https://poser.pugx.org/fastd/console/v/stable)](https://packagist.org/packages/fastd/console) [![Total Downloads](https://poser.pugx.org/fastd/console/downloads)](https://packagist.org/packages/fastd/console) [![Latest Unstable Version](https://poser.pugx.org/fastd/console/v/unstable)](https://packagist.org/packages/fastd/console) [![License](https://poser.pugx.org/fastd/console/license)](https://packagist.org/packages/fastd/console)

PHP CLI Application.

## 要求

* PHP >= 5.6

## Composer

```json
composer require "fastd/console:3.0.x-dev" -vvv
```

## 使用

```php
use FastD\Console\Console;

include_once __DIR__ . '/tests/OutputHelloCommand.php';
include_once __DIR__ . '/tests/OutputWorldCommand.php';

$console = new Console();

$console->addCommand(new OutputWorldCommand());
$console->addCommand(new OutputHelloCommand());

$console->run();
```

## License MIT
