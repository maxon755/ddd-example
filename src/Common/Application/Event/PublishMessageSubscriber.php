<?php

declare(strict_types=1);

namespace MRF\Common\Application\Event;

use MRF\Common\Domain\Event\DomainEvent;
use MRF\Common\Domain\Event\DomainEventSubscriber;
use MRF\Common\Domain\Event\MessagePublisher;

class PublishMessageSubscriber implements DomainEventSubscriber
{
    public function __construct(private MessagePublisher $messagePublisher)
    {
    }

    public function handle(DomainEvent $event): void
    {
        $this->messagePublisher->publish($event);
    }

    public function isSubscribedTo(DomainEvent $event): bool
    {
        return true;
    }
}
