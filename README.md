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
```

### Script

``` php
require_once 'vendor/autoload.php';
$config = Yaml::parse(file_get_contents('config.yaml'));
$conn = new Mkhairul\AMQPWrapper($config, 'rabbit');
echo $conn->sendMessage('message-type', 'Time\'s Up!');
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
