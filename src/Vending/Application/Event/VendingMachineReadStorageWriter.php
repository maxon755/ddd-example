<?php

declare(strict_types=1);

namespace MRF\Vending\Application\Event;

interface VendingMachineReadStorageWriter
{
    /**
     * @param array{
     *     serial_number: string,
     *     name: string,
     *     address: string
     * } $vendingMachineData
     */
    public function add(string $vendingMachineId, array $vendingMachineData): void;
}
