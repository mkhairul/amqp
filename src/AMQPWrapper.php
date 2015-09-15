<?php

namespace Mkhairul\AMQPWrapper;

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AMQPWrapper
{
	protected $conn;
	protected $exchange = [
		'name'		=> '',
		'type'		=> 'fanout',
		'passive'	=> false,
		'durable'	=> false,
		'auto_delete' => true,
		'internal'	=> false,
		'nowait'	=> false,
		'arguments'	=> null,
		'ticket'	=> null
	];
	protected $queue = [
		'name' 		=> '',
		'passive'	=> false,
		'durable'	=> false,
		'exclusive' => false,
		'auto_delete' => true,
		'nowait'	=> false,
		'arguments'	=> null,
		'ticket'	=> null
	];
	/**
	 * Create AMQP connection and merge configs
	 *
	 * @access public
	 * @param  array $config
	 * @return void
	 */
    public function __construct($config, $context = 'rabbit')
    {
        $this->conn = new AMQPConnection($config[$context]['host'],
										 $config[$context]['port'],
										 $config[$context]['login'],
										 $config[$context]['pass'],
										 $config[$context]['vhost']);
		if(array_key_exists('exchange', $config[$context]))
		{
			$this->exchange = array_merge($this->exchange, $config[$context]['exchange']);
		}
		
		if(array_key_exists('queue', $config[$context]))
		{
			$this->queue = array_merge($this->queue, $config[$context]['queue']);
		}
    }
	
	public function setExchange($exchange)
	{
		$this->exchange = array_merge($this->exchange, $exchange);
		return $this;
	}
	
	public function setQueue($queue)
	{
		$this->queue = array_merge($this->queue, $queue);
		return $this;
	}

	/**
	 * Sends the message
	 *
	 * @access public
	 * @param  string $type, string $message
	 * @return void
	 */
    public function sendMessage($type, $message)
    {
        $ch = $this->conn->channel();
		$ch->queue_declare(	$this->queue['name'],
							$this->queue['passive'],
							$this->queue['durable'],
							$this->queue['exclusive'],
							$this->queue['auto_delete'],
							$this->queue['nowait'],
							$this->queue['arguments'],
							$this->queue['ticket']);
		$ch->exchange_declare(	$this->exchange['name'],
								$this->exchange['type'],
								$this->exchange['passive'],
								$this->exchange['durable'],
								$this->exchange['auto_delete'],
								$this->exchange['internal'],
								$this->exchange['nowait'],
								$this->exchange['arguments'],
								$this->exchange['ticket']);
		$ch->queue_bind($this->queue['name'], $this->exchange['name']);
		
		$msg_body = json_encode(['type' => $type, 'data' => $message]);
		$msg = new AMQPMessage($msg_body, array('content_type' => 'text/plain'));
		$ch->basic_publish($msg, $this->exchange['name']);
		
		$ch->close();
		$this->conn->close();
    }
}
