# amqp

Its a [PhpAmqpLib](https://github.com/videlalvaro/php-amqplib) wrapper.

## Install

Via Composer

``` bash
$ composer require mkhairul/amqp
```

## Usage

``` php
$config['rabbit'] = [
  'host' 	=> '...',
  'port' 	=> '...',
  'login' 	=> '...',
  'pass'	=> '...',
  'vhost'	=> '...'
];
$conn = new Mkhairul\AMQPWrapper($config, 'rabbit');
echo $conn->sendMessage('message-type', 'Time\'s Up!');
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
