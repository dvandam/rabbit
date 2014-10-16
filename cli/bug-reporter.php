<?php

require_once __DIR__ . '/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'admin', 'w0YFaH3TwpLl');
$channel = $connection->channel();

$channel->queue_declare('task_queue', false, false, false, false);

$data = implode(' ', array_slice($argv, 1));
if(empty($data)) $data = "Hello World!";
$msg = new AMQPMessage($data,
    array('delivery_mode' => 2) # make message persistent
);

$channel->basic_publish($msg, '', 'task_queue');

echo " [x] Sent ", $data, "\n";

$channel->close();
$connection->close();