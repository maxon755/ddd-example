<?php

use MRF\Common\Domain\Event\EventStore;
use MRF\Common\Domain\Event\PersistEventSubscriber;
use MRF\Common\Infrastructure\Persistence\Doctrine\DoctrineEventStore;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->alias(EventStore::class, DoctrineEventStore::class);
    $services->set(PersistEventSubscriber::class);
};
