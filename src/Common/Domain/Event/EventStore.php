<?php

declare(strict_types=1);

namespace MRF\Common\Domain\Event;

interface EventStore
{
    public function append(DomainEvent $event): void;
}
