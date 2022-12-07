<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure;

use MRF\Common\Domain\Event\DomainEventPublisher;
use MRF\Common\Domain\Event\PersistEventSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class BuildDomainEventPublisherSubscriber implements EventSubscriberInterface
{
    public function __construct(private PersistEventSubscriber $persistEventSubscriber)
    {
    }

    public function onKernelRequest(): void
    {
        DomainEventPublisher::instance()->subscribe($this->persistEventSubscriber);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                'onKernelRequest',
            ],
        ];
    }
}
