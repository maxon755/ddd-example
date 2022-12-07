<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MRF\Vending\Domain\VendingMachine\SerialNumber;
use MRF\Vending\Domain\VendingMachine\VendingMachine;
use MRF\Vending\Domain\VendingMachine\VendingMachineRepository;

/**
 * @extends ServiceEntityRepository<VendingMachine>
 */
class DoctrineVendingMachineRepository extends ServiceEntityRepository implements VendingMachineRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendingMachine::class);
    }

    public function findBySerialNumber(SerialNumber $serialNumber): ?VendingMachine
    {
        return $this->find($serialNumber->serialNumber);
    }

    public function add(VendingMachine $vendingMachine): void
    {
        $this->getEntityManager()->persist($vendingMachine);
    }
}
