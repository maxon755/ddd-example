<?php

declare(strict_types=1);

namespace MRF\Common\Infrastructure\UI\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class TestConsumer implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
        echo 'Heeeeeeeellllloo!!!!!' . PHP_EOL;

        return ConsumerInterface::MSG_ACK;
    }
}
