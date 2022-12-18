<?php

declare(strict_types=1);

namespace MRF\Vending\Application\Query\VendingMachine;

use MRF\Vending\Application\Query\VendingMachineReadModelRepository;

class FindAllVendingMachinesQueryHandler
{
    public function __construct(private VendingMachineReadModelRepository $repository)
    {
    }

    /**
     * @return array<array{serial_number: string, name:string, address:string}>
     */
    public function handle(FindAllVendingMachinesQuery $query): array
    {
        return $this->repository->findAll();
    }
}
