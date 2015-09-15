# amqp

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Its a PhpAmqpLib wrapper.

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
