<?php

declare(strict_types=1);

namespace MRF\Application\Vending\VendingMachine\CreateVendingMachineService;

class CreateVendingMachineRequest
{
    public function __construct(
        public readonly $serialNumber,
        public readonly $name,
        public readonly $address,
        public readonly $operatorPhone,
    ) {
    }
}
