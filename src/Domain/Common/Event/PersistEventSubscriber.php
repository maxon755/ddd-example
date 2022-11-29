<?php

declare(strict_types=1);

namespace MRF\Domain\Common\Event;

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
