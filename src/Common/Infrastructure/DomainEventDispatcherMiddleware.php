<?php

declare(strict_types=1);

namespace MRF\Common\Infrastructure;

use League\Tactician\Middleware;
use MRF\Common\Domain\Event\DomainEventPublisher;

class DomainEventDispatcherMiddleware implements Middleware
{
    public function __construct(private DomainEventPublisher $domainEventPublisher)
    {
    }

    public function execute($command, callable $next)
    {
        $next($command);

        $this->domainEventPublisher->dispatchEvents();
    }
}
