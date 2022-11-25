<?php

declare(strict_types=1);

namespace MRF\Domain\Vending\VendingMachine;

class SerialNumber
{
    public function __construct($serialNumber)
    {
        $this->setSerialNumber($serialNumber);
    }

    private function setSerialNumber($serialNumber): void
    {
        if (empty($serialNumber)) {
            throw new \InvalidArgumentException('Serial number is required.');
        }

        if (!preg_match('/\d{16}/', $serialNumber)) {
            throw new \InvalidArgumentException('Invalid serial number provided.');
        }
    }
}
