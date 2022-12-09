<?php

declare(strict_types=1);

namespace MRF\Common\Application\Event;

use MRF\Common\Domain\Event\DomainEvent;
use MRF\Common\Domain\Event\DomainEventSubscriber;
use MRF\Common\Domain\Event\EventStore;

class PersistEventSubscriber implements DomainEventSubscriber
{
    public function __construct(private EventStore $eventStore)
    {
    }

    public function handle(DomainEvent $event): void
    {
        $this->eventStore->append($event);
    }

    public function isSubscribedTo(DomainEvent $event): bool
    {
        return true;
    }
}
