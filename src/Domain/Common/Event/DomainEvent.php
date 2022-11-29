<?php

declare(strict_types=1);

namespace MRF\Domain\Common\Event;

abstract class DomainEvent
{
    protected \DateTimeImmutable $occurredAt;

    public function __construct()
    {
        $this->occurredAt = new \DateTimeImmutable();
    }

    public function getOccurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}
