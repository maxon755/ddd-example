<?php

declare(strict_types=1);

namespace MRF\Domain\Vending\VendingMachine;

class SerialNumber
{
    public function __construct(public string $serialNumber)
    {
        $this->validateSerialNumber($serialNumber);
    }

    public function __toString(): string
    {
        return $this->serialNumber;
    }

    private function validateSerialNumber(string $serialNumber): void
    {
        if (!preg_match('/\d{16}/', $serialNumber)) {
            throw new \InvalidArgumentException('Invalid serial number provided.');
        }
    }
}
