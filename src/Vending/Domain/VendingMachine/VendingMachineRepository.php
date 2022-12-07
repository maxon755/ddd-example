<?php

declare(strict_types=1);

namespace MRF\Vending\Domain\VendingMachine;

interface VendingMachineRepository
{
    public function findBySerialNumber(SerialNumber $serialNumber): ?VendingMachine;

    public function add(VendingMachine $vendingMachine): void;
}
