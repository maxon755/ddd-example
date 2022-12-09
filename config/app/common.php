<?php

use MRF\Common\Application\Event\PersistEventSubscriber;
use MRF\Common\Domain\Event\DomainEventPublisher;
use MRF\Common\Domain\Event\EventStore;
use MRF\Common\Infrastructure\Persistence\Doctrine\DoctrineEventStore;
use MRF\Vending\Application\Event\VendingMachineSyncSubscriber;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->alias(EventStore::class, DoctrineEventStore::class);
    $services->set(PersistEventSubscriber::class);

    $services->set(DomainEventPublisher::class)
        ->factory([DomainEventPublisher::class, 'instance'])
        ->call('subscribe', [service(PersistEventSubscriber::class)])
        ->call('subscribe', [service(VendingMachineSyncSubscriber::class)])
    ;
};
