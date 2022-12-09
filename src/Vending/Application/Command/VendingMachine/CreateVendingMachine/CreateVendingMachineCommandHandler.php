<?php

declare(strict_types=1);

namespace MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine;

use MRF\Vending\Domain\VendingMachine\SerialNumber;
use MRF\Vending\Domain\VendingMachine\VendingMachine;
use MRF\Vending\Domain\VendingMachine\VendingMachineAlreadyExistsException;
use MRF\Vending\Domain\VendingMachine\VendingMachineRepository;

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
