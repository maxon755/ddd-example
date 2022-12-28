<?php

declare(strict_types=1);

namespace MRF\Vending\Application\Event;

use MRF\Common\Domain\Event\DomainEvent;
use MRF\Common\Domain\Event\DomainEventSubscriber;
use MRF\Vending\Domain\VendingMachine\VendingMachineRepository;
use MRF\Vending\Domain\VendingMachine\VendingMachineWasCreated;

class VendingMachineSyncSubscriber implements DomainEventSubscriber
{
    public function __construct(
        private VendingMachineRepository $vendingMachineRepository,
        private VendingMachineReadStorageWriter $vendingMachineReadStorageWriter,
    ) {
    }

    /**
     * @param VendingMachineWasCreated $event
     */
    public function handle(DomainEvent $event): void
    {
        $serialNumber = $event->getSerialNumber();

        $vendingMachine = $this->vendingMachineRepository->findBySerialNumber($serialNumber);

        if (null === $vendingMachine) {
            // TODO: create appropriate exception
            throw new \Exception('Vending machine not found');
        }

        // TODO: vending machine serialization
        $data = [
            'serial_number' => (string) $vendingMachine->getSerialNumber(),
            'name' => $vendingMachine->getName(),
            'address' => $vendingMachine->getAddress(),
        ];

        $this->vendingMachineReadStorageWriter->add((string) $serialNumber, $data);
    }

    public function isSubscribedTo(DomainEvent $event): bool
    {
        return $event instanceof VendingMachineWasCreated;
    }
}
