<?php

declare(strict_types=1);

namespace MRF\Tests\Application\Vending;

use MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineRequest;
use MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineService;
use MRF\Domain\Vending\VendingMachine\SerialNumber;
use MRF\Domain\Vending\VendingMachine\VendingMachine;
use MRF\Domain\Vending\VendingMachine\VendingMachineAlreadyExistsException;
use MRF\Domain\Vending\VendingMachine\VendingMachineRepository;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineService
 */
final class CreateVendingMachineTest extends TestCase
{
    private VendingMachineRepository $repository;

    private CreateVendingMachineService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(VendingMachineRepository::class);
        $this->service = new CreateVendingMachineService($this->repository);
    }

    public function test_vending_machine_can_be_created()
    {
        $this->repository
            ->expects(static::once())
            ->method('findBySerialNumber')
            ->with(new SerialNumber('1111222233334444'))
        ;
        $this->repository
            ->expects(static::once())
            ->method('add')
        ;

        $request = new CreateVendingMachineRequest(
            serialNumber: '1111222233334444',
            name: 'X-vending',
            address: 'Valhalla',
            operatorPhone: '4204242',
        );

        $this->service->execute($request);
    }

    public function test_vending_machine_can_not_be_created_with_the_same_serial_number()
    {
        $this->repository
            ->expects(static::once())
            ->method('findBySerialNumber')
            ->willReturn(VendingMachine::create(
                new SerialNumber('1111222233334444'),
                'X-vending',
                'Valhalla'
            ))
        ;

        $request = new CreateVendingMachineRequest(
            serialNumber: '1111222233334444',
            name: 'X-vending',
            address: 'Valhalla',
            operatorPhone: '4204242',
        );

        $this->expectException(VendingMachineAlreadyExistsException::class);
        $this->service->execute($request);
    }
}
