<?php

declare(strict_types=1);

namespace MRF\Vending\Domain\VendingMachine;

use MRF\Common\Domain\Event\DomainEvent;

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
