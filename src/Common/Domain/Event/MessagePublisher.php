<?php

declare(strict_types=1);

namespace MRF\Common\Domain\Event;

interface MessagePublisher
{
    public function publish(DomainEvent $event): void;
}
