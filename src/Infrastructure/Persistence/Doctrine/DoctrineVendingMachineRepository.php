<?php

declare(strict_types=1);

namespace MRF\Infrastructure\Persistence\Doctrine;

use Doctrine\Persistence\ManagerRegistry;
use MRF\Domain\Vending\VendingMachine\SerialNumber;
use MRF\Domain\Vending\VendingMachine\VendingMachine;
use MRF\Domain\Vending\VendingMachine\VendingMachineRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
        return $this->find($serialNumber->value());
    }

    public function add(VendingMachine $vendingMachine): void
    {
        $this->getEntityManager()->persist($vendingMachine);
    }
}