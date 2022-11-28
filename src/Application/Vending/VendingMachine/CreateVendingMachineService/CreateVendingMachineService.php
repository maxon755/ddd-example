<?php

declare(strict_types=1);

namespace MRF\Application\Vending\VendingMachine\CreateVendingMachineService;

use MRF\Application\ApplicationService;
use MRF\Domain\Vending\VendingMachine\SerialNumber;
use MRF\Domain\Vending\VendingMachine\VendingMachine;
use MRF\Domain\Vending\VendingMachine\VendingMachineAlreadyExistsException;
use MRF\Domain\Vending\VendingMachine\VendingMachineRepository;

class CreateVendingMachineService implements ApplicationService
{
    public function __construct(private VendingMachineRepository $vendingMachineRepository)
    {
    }

    /**
     * @param CreateVendingMachineRequest $request
     *
     * @throws VendingMachineAlreadyExistsException
     */
    public function execute($request): void
    {
        $serialNumber = new SerialNumber($request->serialNumber);

        if (null !== $this->vendingMachineRepository->findBySerialNumber($serialNumber)) {
            throw VendingMachineAlreadyExistsException::create($serialNumber);
        }

        $vendingMachine = VendingMachine::create(
            $serialNumber,
            $request->name,
            $request->address,
        );
        $vendingMachine->setOperatorPhone($request->operatorPhone);

        $this->vendingMachineRepository->add($vendingMachine);
    }
}
