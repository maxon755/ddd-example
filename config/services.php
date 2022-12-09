<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use MRF\Common\Infrastructure\DomainEventDispatcherMiddleware;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()                // Automatically injects dependencies in your services.
        ->autoconfigure()           // Automatically registers your services as commands, event subscribers, etc.
    ;

    // make classes in src/ available to be used as services
    // this creates a service per class whose id is the fully-qualified class name
    $services->load('MRF\\', __DIR__ . '/../src/')
        ->exclude([
            '../src/Vending/Domain',
            '../src/Common/Infrastructure/UI/Http/Kernel.php',
            '../src/*/config/*',
        ])
    ;

    // Imports must be after load to rewrite tags
    $configurator->import(__DIR__ . '/app/vending.php');
    $configurator->import(__DIR__ . '/app/common.php');

    $services->set('command-bus.middleware.dispatch-domain-events', DomainEventDispatcherMiddleware::class);
};
