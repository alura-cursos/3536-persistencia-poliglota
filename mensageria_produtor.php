<?php

declare(strict_types=1);

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once 'vendor/autoload.php';

$connection = new AMQPStreamConnection(
    'mensageria',
    5672,
    'guest',
    'guest'
);
$channel = $connection->channel();
$channel->queue_declare('product_bought', auto_delete: false);

$msg = new AMQPMessage('Outra mensagem');
$channel->basic_publish($msg, '', 'product_bought');

echo "Mensagem enviada \n";

$channel->close();
$connection->close();
