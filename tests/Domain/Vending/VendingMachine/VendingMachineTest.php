<?php

declare(strict_types=1);

namespace MRF\Tests\Domain\Vending\VendingMachine;

use MRF\Domain\Common\Event\DomainEventPublisher;
use MRF\Domain\Vending\VendingMachine\SerialNumber;
use MRF\Domain\Vending\VendingMachine\VendingMachine;
use MRF\Domain\Vending\VendingMachine\VendingMachineWasCreated;
use MRF\Tests\Utils\SpySubscriber;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \MRF\Domain\Vending\VendingMachine\VendingMachine
 */
final class VendingMachineTest extends TestCase
{
    public function test_it_fires_event_on_creation()
    {
        $spy = new SpySubscriber();
        DomainEventPublisher::instance()->subscribe($spy);

        VendingMachine::create(
            $serialNumber = new SerialNumber('1111222233334444'),
            'test',
            'test,'
        );

        static::assertInstanceOf(VendingMachineWasCreated::class, $spy->domainEvent);
        static::assertSame($serialNumber, $spy->domainEvent->serialNumber());
    }
}
