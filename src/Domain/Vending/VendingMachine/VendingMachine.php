<?php

declare(strict_types=1);

namespace MRF\Domain\Vending\VendingMachine;

use DateTimeInterface;
use DateTimeImmutable;

class VendingMachine
{
    private SerialNumber $serialNumber;

    private string $name;

    private string $address;

    private ?string $operatorPhone = null;

    private DateTimeInterface $createdAt;

    private DateTimeInterface $activatedAt;

    private ?DateTimeInterface $lastRequestedAt = null;

    private function __construct(
        SerialNumber $serialNumber,
    ) {
        $this->serialNumber = $serialNumber;
        $this->createdAt = new DateTimeImmutable();
    }

    public static function create(SerialNumber $serialNumber) : self
    {
        return new self($serialNumber);
    }

    public function serialNumber() : SerialNumber
    {
        return $this->serialNumber;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function address() : string
    {
        return $this->address;
    }

    public function setAddress(string $address) : void
    {
        $this->address = $address;
    }

    public function operatorPhone() : string
    {
        return $this->operatorPhone;
    }

    public function setOperatorPhone(string $operatorPhone) : void
    {
        $this->operatorPhone = $operatorPhone;
    }

    public function createdAt() : DateTimeImmutable|DateTimeInterface
    {
        return $this->createdAt;
    }

    public function activatedAt() : DateTimeInterface
    {
        return $this->activatedAt;
    }

    public function setActivatedAt(DateTimeInterface $activatedAt) : void
    {
        $this->activatedAt = $activatedAt;
    }

    public function lastRequestedAt() : DateTimeInterface
    {
        return $this->lastRequestedAt;
    }

    public function setLastRequestedAt(DateTimeInterface $lastRequestedAt) : void
    {
        $this->lastRequestedAt = $lastRequestedAt;
    }
}
