<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use MRF\Vending\Infrastructure\UI\CLI\CreateVendingMachineRedisearchIndex;
use MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine\CreateVendingMachineCommandHandler;
use MRF\Vending\Application\Query\VendingMachineReadModelRepository;
use MRF\Vending\Domain\VendingMachine\VendingMachineRepository;
use MRF\Vending\Infrastructure\Persistence\Doctrine\DoctrineVendingMachineRepository;
use MRF\Vending\Infrastructure\Persistence\Redis\RedisVendingMachineReadModelRepository;
use MRF\Vending\Infrastructure\Persistence\Redis\RedisVendingMachineReadStorageWriter;

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

    $services->set(RedisVendingMachineReadStorageWriter::class)
        ->args([service('redis.client')])
    ;
    $services->set(RedisVendingMachineReadModelRepository::class)
        ->args([service('redis.redisearch.client')])
    ;
    $services->alias(
        VendingMachineReadModelRepository::class,
        RedisVendingMachineReadModelRepository::class
    );

    $services->set(CreateVendingMachineCommandHandler::class)
        ->tag('tactician.handler', ['typehints' => true])
    ;

    // console
    $services->set(CreateVendingMachineRedisearchIndex::class)
        ->args([service('redis.redisearch.client')])
    ;
};
