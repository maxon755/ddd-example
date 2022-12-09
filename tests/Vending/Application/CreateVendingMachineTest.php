<?php

declare(strict_types=1);

namespace MRF\Tests\Vending\Application;

use MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine\CreateVendingMachineCommand;
use MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine\CreateVendingMachineCommandHandler;
use MRF\Vending\Domain\VendingMachine\SerialNumber;
use MRF\Vending\Domain\VendingMachine\VendingMachine;
use MRF\Vending\Domain\VendingMachine\VendingMachineAlreadyExistsException;
use MRF\Vending\Domain\VendingMachine\VendingMachineRepository;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine\CreateVendingMachineCommandHandler
 */
final class CreateVendingMachineTest extends TestCase
{
    private VendingMachineRepository $repository;

    private CreateVendingMachineCommandHandler $commandHandler;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(VendingMachineRepository::class);
        $this->commandHandler = new CreateVendingMachineCommandHandler($this->repository);
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

        $command = new CreateVendingMachineCommand(
            serialNumber: '1111222233334444',
            name: 'X-vending',
            address: 'Valhalla',
            operatorPhone: '4204242',
        );

        $this->commandHandler->handle($command);
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

        $command = new CreateVendingMachineCommand(
            serialNumber: '1111222233334444',
            name: 'X-vending',
            address: 'Valhalla',
            operatorPhone: '4204242',
        );

        $this->expectException(VendingMachineAlreadyExistsException::class);
        $this->commandHandler->handle($command);
    }
}
