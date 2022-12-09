<?php

declare(strict_types=1);

namespace MRF\Vending\Application\Query;

interface VendingMachineReadModelRepository
{
    /**
     * @param string $vendingMachineId
     * @param array{
     *     serial_number: string,
     *     name: string,
     *     address: string
     * } $vendingMachineData
     */
    public function add(string $vendingMachineId, array $vendingMachineData): void;
}
