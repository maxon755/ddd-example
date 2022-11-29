<?php

declare(strict_types=1);

namespace MRF\Infrastructure\Persistence\Doctrine\Serializer;

use MRF\Domain\Vending\VendingMachine\VendingMachineWasCreated;

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
    public function getSerializerForEvent(string $domainEventClass): EventSerializer
    {
        if (!\array_key_exists($domainEventClass, $this->serializersMap)) {
            throw SerializerNotConfigured::create($domainEventClass);
        }

        $serializerClass = $this->serializersMap[$domainEventClass];

        /** @var EventSerializer */
        return new $serializerClass();
    }
}