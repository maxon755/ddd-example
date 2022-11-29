<?php

declare(strict_types=1);

namespace MRF\Domain\Common\Event;

interface DomainEventSubscriber
{
    public function handle(DomainEvent $event): void;

    public function isSubscribedTo(DomainEvent $event): bool;
}
