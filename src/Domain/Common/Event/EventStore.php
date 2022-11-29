<?php

declare(strict_types=1);

namespace MRF\Domain\Common\Event;

interface EventStore
{
    public function append(DomainEvent $event): void;
}
