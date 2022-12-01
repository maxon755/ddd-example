<?php

declare(strict_types=1);

namespace MRF\Domain\Vending\VendingMachine;

use MRF\Domain\Common\Event\DomainEvent;

class VendingMachineWasCreated extends DomainEvent
{
    protected SerialNumber $serialNumber;

    public function __construct(SerialNumber $serialNumber, ?\DateTimeImmutable $occurredAt = null)
    {
        $this->serialNumber = $serialNumber;
        $this->occurredAt = $occurredAt ?? new \DateTimeImmutable();
    }

    public function getSerialNumber(): SerialNumber
    {
        return $this->serialNumber;
    }
}
