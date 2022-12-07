<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure;

use League\Tactician\Middleware;
use MRF\Common\Domain\Event\DomainEventPublisher;

class DomainEventDispatcherMiddleware implements Middleware
{
    public function execute($command, callable $next)
    {
        $next($command);

        DomainEventPublisher::instance()->dispatchEvents();
    }
}
