<?php

declare(strict_types=1);

namespace MRF\Common\Infrastructure\UI\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class FailedMessagesConsumer implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
        echo 'ALERTE!!! SOMETHING WENT WRONG!!!' . PHP_EOL;
        
        return ConsumerInterface::MSG_ACK;
    }
}
