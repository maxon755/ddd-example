<?php

declare(strict_types=1);

namespace MRF\Application\Vending\VendingMachine\CreateVendingMachineService;

use MRF\Domain\Vending\VendingMachine\SerialNumber;
use MRF\Domain\Vending\VendingMachine\VendingMachine;
use MRF\Domain\Vending\VendingMachine\VendingMachineRepository;

class CreateVendingMachineService
{
    public function __construct(private VendingMachineRepository $vendingMachineRepository)
    {
    }

    public function execute(CreateVendingMachineRequest $request)
    {
        $vendingMachine = VendingMachine::create(
            new SerialNumber($request->serialNumber)
        );
        $vendingMachine->setName($request->name);
        $vendingMachine->setAddress($request->address);
        $vendingMachine->setOperatorPhone($request->operatorPhone);

        $this->vendingMachineRepository->add($vendingMachine);
    }
}
