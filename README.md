# amqp

Its a [PhpAmqpLib](https://github.com/videlalvaro/php-amqplib) wrapper.

## Install

Via Composer

``` bash
$ composer require mkhairul/amqp dev-master
```

## Usage

### YAML Config File (config.yaml)
``` yaml
rabbit:
  host: localhost
  port: 5672
  login: guest
  pass: guest
  vhost: /
  exchange:
    name: someExchange
  queue:
	name: someQueue
```

### Script

``` php
<?php
require_once 'vendor/autoload.php';
use Symfony\Component\Yaml\Yaml;
use Mkhairul\AMQPWrapper\AMQPWrapper;

$config = Yaml::parse(file_get_contents('config.yaml'));
$conn = new AMQPWrapper($config, 'rabbit');
$conn->sendMessage('message-type', 'Time\'s Up!');
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
