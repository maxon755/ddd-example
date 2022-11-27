<?php

declare(strict_types=1);

namespace MRF\Tests\Utils;

use MRF\Domain\Common\Event\DomainEvent;
use MRF\Domain\Common\Event\DomainEventSubscriber;

class SpySubscriber implements DomainEventSubscriber
{
    public DomainEvent $domainEvent;

    public function handle(DomainEvent $domainEvent): void
    {
        $this->domainEvent = $domainEvent;
    }

    public function isSubscribedTo(DomainEvent $domainEvent): bool
    {
        return true;
    }
}
