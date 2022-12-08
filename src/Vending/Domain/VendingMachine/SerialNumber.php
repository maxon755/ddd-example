<?php

declare(strict_types=1);

namespace MRF\Vending\Domain\VendingMachine;

class SerialNumber
{
    public const LENGTH = 16;

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
        if (!preg_match('/\d{' . self::LENGTH . '}/', $serialNumber)) {
            throw new \InvalidArgumentException('Invalid serial number provided.');
        }
    }
}
