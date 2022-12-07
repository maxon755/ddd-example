<?php

declare(strict_types=1);

namespace MRF\Common\Domain\Event;

abstract class DomainEvent
{
    protected \DateTimeImmutable $occurredAt;

    public function getOccurredAt(): \DateTimeImmutable
    {
        return $this->occurredAt;
    }
}
