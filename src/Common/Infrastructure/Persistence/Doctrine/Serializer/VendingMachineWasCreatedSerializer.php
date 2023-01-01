<?php

declare(strict_types=1);

namespace MRF\Common\Infrastructure\Persistence\Doctrine\Serializer;

use MRF\Common\Domain\Event\DomainEvent;
use MRF\Vending\Domain\VendingMachine\VendingMachineWasCreated;

class VendingMachineWasCreatedSerializer implements EventSerializer
{
    /**
     * @param VendingMachineWasCreated $event
     *
     * @throws \JsonException
     */
    public function serialize(DomainEvent $event): string
    {
        return json_encode([
            'serial_number' => $event->getSerialNumber()->serialNumber,
            'occured_at' => $event->getOccurredAt(),
        ], JSON_THROW_ON_ERROR);
    }
}
