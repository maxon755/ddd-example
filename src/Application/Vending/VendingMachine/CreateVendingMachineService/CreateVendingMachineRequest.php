<?php

declare(strict_types=1);

namespace MRF\Application\Vending\VendingMachine\CreateVendingMachineService;

class CreateVendingMachineRequest
{
    public function __construct(
        public readonly string $serialNumber,
        public readonly string $name,
        public readonly string $address,
        public readonly ?string $operatorPhone = null,
    ) {
    }
}
