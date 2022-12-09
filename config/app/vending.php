<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine\CreateVendingMachineCommandHandler;
use MRF\Vending\Application\Query\VendingMachineReadModelRepository;
use MRF\Vending\Domain\VendingMachine\VendingMachineRepository;
use MRF\Vending\Infrastructure\Persistence\Doctrine\DoctrineVendingMachineRepository;
use MRF\Vending\Infrastructure\Persistence\Redis\RedisVendingMachineReadModelRepository;

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

    $services->alias(
        VendingMachineReadModelRepository::class,
        RedisVendingMachineReadModelRepository::class
    );

    $services->set(RedisVendingMachineReadModelRepository::class)
        ->args([service('snc_redis.default')])
    ;

    $services->set(CreateVendingMachineCommandHandler::class)
        ->tag('tactician.handler', ['typehints' => true])
    ;
};
