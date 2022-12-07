<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use MRF\Vending\Infrastructure\DomainEventDispatcherMiddleware;
use MRF\Vending\Application\VendingMachine\CreateVendingMachine\CreateVendingMachineCommandHandler;
use MRF\Common\Domain\Event\EventStore;
use MRF\Common\Domain\Event\PersistEventSubscriber;
use MRF\Vending\Domain\VendingMachine\VendingMachineRepository;
use MRF\Vending\Infrastructure\DomainSubscriber\SyncVendingMachineInMemorySubscriber;
use MRF\Vending\Infrastructure\Persistence\Doctrine\DoctrineEventStore;
use MRF\Vending\Infrastructure\Persistence\Doctrine\DoctrineVendingMachineRepository;

return function (ContainerConfigurator $configurator) {
    // default configuration for services in *this* file
    $services = $configurator->services()
        ->defaults()
        ->autowire()      // Automatically injects dependencies in your services.
        ->autoconfigure() // Automatically registers your services as commands, event subscribers, etc.
    ;

    // make classes in src/ available to be used as services
    // this creates a service per class whose id is the fully-qualified class name
    $services->load('MRF\\', '../src/')
        ->exclude([
            '../src/Domain',
            '../src/Infrastructure/Kernel.php',
            '../src/Infrastructure/EntryPoint/Http/public/index.php',
        ])
    ;

    // order is important in this file because service definitions
    // always *replace* previous ones; add your own service configuration below

    $services->alias(
        VendingMachineRepository::class,
        DoctrineVendingMachineRepository::class
    );

    $services->alias(EventStore::class, DoctrineEventStore::class);

    $services->set(PersistEventSubscriber::class);

    $services->set(CreateVendingMachineCommandHandler::class)
        ->tag('tactician.handler', ['typehints' => true])
    ;

    $services->set(SyncVendingMachineInMemorySubscriber::class)
        ->arg('$redisClient', service('snc_redis.default'))
    ;

    $services->set('command-bus.middleware.dispatch-domain-events', DomainEventDispatcherMiddleware::class);
};
