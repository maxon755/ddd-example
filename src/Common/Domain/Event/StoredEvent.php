<?php

declare(strict_types=1);

namespace MRF\Common\Domain\Event;

class StoredEvent
{
    public readonly int $eventId;

    public function __construct(
        public readonly string $eventType,
        public readonly string $body,
        public readonly \DateTimeImmutable $occurredAt
    ) {
    }
}
