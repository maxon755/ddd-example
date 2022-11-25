<?php

declare(strict_types=1);

namespace MRF\Tests\Application\Vending;

use MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineRequest;
use MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineService;
use MRF\Domain\Vending\VendingMachine\VendingMachineRepository;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineService
 */
final class CreateVendingMachineTest extends TestCase
{
    public function testVendingMachineCanBeCreated()
    {
        $repository = $this->createMock(VendingMachineRepository::class);

        $repository
            ->expects(self::once())
            ->method('add')
        ;

        $service = new CreateVendingMachineService($repository);

        $request = new CreateVendingMachineRequest(
            '1111222233334444'
        );

        $service->execute($request);
    }
}
