<?php

declare(strict_types=1);

namespace MRF\Common\Domain\Event;

interface DomainEventSubscriber
{
    public function handle(DomainEvent $event): void;

    public function isSubscribedTo(DomainEvent $event): bool;
}
