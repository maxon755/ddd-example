<?php

declare(strict_types=1);

namespace MRF\Domain\Common\Event;

/**
 * @see \MRF\Infrastructure\BuildDomainEventPublisherSubscriber
 */
class DomainEventPublisher
{
    protected static ?self $instance = null;

    /**
     * @var DomainEventSubscriber[]
     */
    protected array $subscribers = [];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function instance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function subscribe(DomainEventSubscriber $subscriber): void
    {
        $this->subscribers[] = $subscriber;
    }

    public function publish(DomainEvent $event): void
    {
        foreach ($this->subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($event)) {
                $subscriber->handle($event);
            }
        }
    }
}
