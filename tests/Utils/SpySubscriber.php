<?php

declare(strict_types=1);

namespace MRF\Tests\Utils;

use MRF\Common\Domain\Event\DomainEvent;
use MRF\Common\Domain\Event\DomainEventSubscriber;

class SpySubscriber implements DomainEventSubscriber
{
    public DomainEvent $domainEvent;

    public function handle(DomainEvent $event): void
    {
        $this->domainEvent = $event;
    }

    public function isSubscribedTo(DomainEvent $event): bool
    {
        return true;
    }
}
