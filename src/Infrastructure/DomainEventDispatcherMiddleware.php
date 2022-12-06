<?php

declare(strict_types=1);

namespace MRF\Infrastructure;

use League\Tactician\Middleware;
use MRF\Domain\Common\Event\DomainEventPublisher;

class DomainEventDispatcherMiddleware implements Middleware
{

    public function execute($command, callable $next)
    {
        $next($command);

        DomainEventPublisher::instance()->dispatchEvents();
    }
}
