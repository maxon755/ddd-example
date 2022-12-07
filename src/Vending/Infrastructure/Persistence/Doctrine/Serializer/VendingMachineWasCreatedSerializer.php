<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Doctrine\Serializer;

use MRF\Domain\Common\Event\DomainEvent;
use MRF\Domain\Vending\VendingMachine\VendingMachineWasCreated;

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
        ], JSON_THROW_ON_ERROR);
    }
}
