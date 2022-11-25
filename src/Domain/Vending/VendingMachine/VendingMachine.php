<?php

declare(strict_types=1);

namespace MRF\Domain\Vending\VendingMachine;

class VendingMachine
{
    private SerialNumber $serialNumber;

    private string $name;

    private string $address;

    private ?string $operatorPhone = null;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $activatedAt = null;

    private ?\DateTimeImmutable $lastRequestedAt = null;

    private function __construct(
        SerialNumber $serialNumber,
        string $name,
        string $address,
    ) {
        $this->serialNumber = $serialNumber;
        $this->name = $name;
        $this->address = $address;
        $this->createdAt = new \DateTimeImmutable();
    }

    public static function create(
        SerialNumber $serialNumber,
        string $name,
        string $address,
    ): self {
        return new self($serialNumber, $name, $address);
    }

    public function serialNumber(): SerialNumber
    {
        return $this->serialNumber;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function address(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function operatorPhone(): ?string
    {
        return $this->operatorPhone;
    }

    public function setOperatorPhone(?string $operatorPhone): void
    {
        $this->operatorPhone = $operatorPhone;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function activatedAt(): ?\DateTimeImmutable
    {
        return $this->activatedAt;
    }

    public function setActivatedAt(\DateTimeImmutable $activatedAt): void
    {
        $this->activatedAt = $activatedAt;
    }

    public function lastRequestedAt(): ?\DateTimeImmutable
    {
        return $this->lastRequestedAt;
    }

    public function setLastRequestedAt(\DateTimeImmutable $lastRequestedAt): void
    {
        $this->lastRequestedAt = $lastRequestedAt;
    }
}
