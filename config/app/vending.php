<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine\CreateVendingMachineCommandHandler;
use MRF\Vending\Domain\VendingMachine\VendingMachineRepository;
use MRF\Vending\Infrastructure\Persistence\Doctrine\DoctrineVendingMachineRepository;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->alias(
        VendingMachineRepository::class,
        DoctrineVendingMachineRepository::class
    );

    $services->set(CreateVendingMachineCommandHandler::class)
        ->tag('tactician.handler', ['typehints' => true])
    ;
};
