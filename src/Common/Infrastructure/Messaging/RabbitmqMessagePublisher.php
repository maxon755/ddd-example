<?php

declare(strict_types=1);

namespace MRF\Common\Infrastructure\Messaging;

use MRF\Common\Domain\Event\DomainEvent;
use MRF\Common\Domain\Event\MessagePublisher;
use MRF\Common\Infrastructure\Persistence\Doctrine\Serializer\EventSerializerFactory;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class RabbitmqMessagePublisher implements MessagePublisher
{
    public function __construct(
        private ProducerInterface $domainBusProducer,
        private EventSerializerFactory $serializerFactory
    ) {
    }

    public function publish(DomainEvent $event): void
    {
        $serializer = $this->serializerFactory->getSerializerForEvent($event);

        $message = $serializer->serialize($event);

        $this->domainBusProducer->publish($message, 'vending_machine.created');
    }
}
