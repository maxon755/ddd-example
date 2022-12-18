<?php

declare(strict_types=1);

namespace MRF\Vending\Application\Query;

interface VendingMachineReadModelRepository
{
    /**
     * @return array<array{serial_number: string, name:string, address:string}>
     */
    public function findAll(): array;
}
