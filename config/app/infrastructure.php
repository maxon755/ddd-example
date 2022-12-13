<?php

use MacFJA\RediSearch\Redis\Client;
use MacFJA\RediSearch\Redis\Client\ClientFacade;
use MRF\Vending\Infrastructure\Persistence\Redis\RedisVendingMachineReadStorageWriter;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->alias('redis.client', 'snc_redis.default');

    $services->set('redis.redisearch.client_facade', ClientFacade::class);

    $services->set('redis.redisearch.client', Client::class)
        ->factory([service('redis.redisearch.client_facade'), 'getClient'])
        ->args([service('redis.client')])
    ;

//    $services->set(RedisVendingMachineReadStorageWriter::class)
//        ->args([service('redis.redisearch.client')])
};
