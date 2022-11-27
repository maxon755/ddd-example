<?php

declare(strict_types=1);

namespace MRF\Domain\Vending\VendingMachine;

use MRF\Domain\Common\Event\DomainEvent;

class VendingMachineWasCreated extends DomainEvent
{
    private SerialNumber $serialNumber;

    public function __construct(SerialNumber $serialNumber)
    {
        $this->serialNumber = $serialNumber;

        parent::__construct();
    }

    public function serialNumber(): SerialNumber
    {
        return $this->serialNumber;
    }
}
