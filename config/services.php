<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use MRF\Application\Vending\VendingMachine\CreateVendingMachine\CreateVendingMachineCommandHandler;
use MRF\Domain\Vending\VendingMachine\VendingMachineRepository;
use MRF\Infrastructure\Persistence\Doctrine\DoctrineVendingMachineRepository;

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

    $services->set(CreateVendingMachineCommandHandler::class)
        ->tag('tactician.handler', ['typehints' => true])
    ;
};
