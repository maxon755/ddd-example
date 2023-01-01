<?php

declare(strict_types=1);

namespace MRF\Common\Infrastructure\Persistence\Doctrine\Serializer;

use MRF\Common\Domain\Event\DomainEvent;
use MRF\Vending\Domain\VendingMachine\VendingMachineWasCreated;

class EventSerializerFactory
{
    /**
     * @var string[]
     */
    private array $serializersMap = [
        VendingMachineWasCreated::class => VendingMachineWasCreatedSerializer::class,
    ];

    /**
     * @throws SerializerNotConfigured
     */
    public function getSerializerForEvent(DomainEvent $event): EventSerializer
    {
        $domainEventClass = \get_class($event);

        if (!\array_key_exists($domainEventClass, $this->serializersMap)) {
            throw SerializerNotConfigured::create($domainEventClass);
        }

        $serializerClass = $this->serializersMap[$domainEventClass];

        /** @var EventSerializer */
        return new $serializerClass();
    }
}
