<?php

declare(strict_types=1);

namespace MRF\Tests\Vending\Domain\VendingMachine;

use MRF\Common\Domain\Event\DomainEventPublisher;
use MRF\Tests\Utils\SpySubscriber;
use MRF\Vending\Domain\VendingMachine\SerialNumber;
use MRF\Vending\Domain\VendingMachine\VendingMachine;
use MRF\Vending\Domain\VendingMachine\VendingMachineWasCreated;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @covers \MRF\Vending\Domain\VendingMachine\VendingMachine
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

        DomainEventPublisher::instance()->dispatchEvents();

        static::assertInstanceOf(VendingMachineWasCreated::class, $spy->domainEvent);
        static::assertSame($serialNumber, $spy->domainEvent->getSerialNumber());
    }
}
