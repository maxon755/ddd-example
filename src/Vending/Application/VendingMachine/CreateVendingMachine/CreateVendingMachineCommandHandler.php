<?php

declare(strict_types=1);

namespace MRF\Vending\Application\VendingMachine\CreateVendingMachine;

use MRF\Domain\Vending\VendingMachine\SerialNumber;
use MRF\Domain\Vending\VendingMachine\VendingMachine;
use MRF\Domain\Vending\VendingMachine\VendingMachineAlreadyExistsException;
use MRF\Domain\Vending\VendingMachine\VendingMachineRepository;

class CreateVendingMachineCommandHandler
{
    public function __construct(private VendingMachineRepository $vendingMachineRepository)
    {
    }

    /**
     * @throws VendingMachineAlreadyExistsException
     */
    public function handle(CreateVendingMachineCommand $command): void
    {
        $serialNumber = new SerialNumber($command->serialNumber);

        if (null !== $this->vendingMachineRepository->findBySerialNumber($serialNumber)) {
            throw VendingMachineAlreadyExistsException::create($serialNumber);
        }

        $vendingMachine = VendingMachine::create(
            $serialNumber,
            $command->name,
            $command->address,
        );
        $vendingMachine->setOperatorPhone($command->operatorPhone);

        $this->vendingMachineRepository->add($vendingMachine);
    }
}
