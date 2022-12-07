<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Doctrine\Serializer;

use MRF\Common\Domain\Event\DomainEvent;

interface EventSerializer
{
    public function serialize(DomainEvent $event): string;
}
