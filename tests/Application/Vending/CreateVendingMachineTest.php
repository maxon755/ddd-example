<?php

declare(strict_types=1);

namespace MRF\Tests\Application\Vending;

use PHPUnit\Framework\TestCase;
use MRF\Domain\Vending\VendingMachine\VendingMachineRepository;
use MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineService;
use MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineRequest;

class CreateVendingMachineTest extends TestCase
{
    public function test_vending_machine_can_be_created()
    {
        $repository = $this->createMock(VendingMachineRepository::class);

        $repository
            ->expects($this->once())
            ->method('add');

        $service = new CreateVendingMachineService($repository);

        $request = new CreateVendingMachineRequest(
            '1111222233334444'
        );

        $service->execute($request);
    }
}
