<?php

declare(strict_types=1);

namespace MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine;

class CreateVendingMachineCommand
{
    public function __construct(
        public readonly string $serialNumber,
        public readonly string $name,
        public readonly string $address,
        public readonly ?string $operatorPhone = null,
    ) {
    }
}
