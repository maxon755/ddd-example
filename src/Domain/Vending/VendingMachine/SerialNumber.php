<?php

declare(strict_types=1);

namespace MRF\Domain\Vending\VendingMachine;

class SerialNumber
{
    private string $serialNumber;

    public function __construct(string $serialNumber)
    {
        $this->validateSerialNumber($serialNumber);

        $this->serialNumber = $serialNumber;
    }

    public function value(): string
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
