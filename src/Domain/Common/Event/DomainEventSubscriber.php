<?php

declare(strict_types=1);

namespace MRF\Domain\Common\Event;

interface DomainEventSubscriber
{
    public function handle(DomainEvent $domainEvent): void;

    public function isSubscribedTo(DomainEvent $domainEvent): bool;
}
