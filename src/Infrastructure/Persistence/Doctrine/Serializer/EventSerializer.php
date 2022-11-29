<?php

declare(strict_types=1);

namespace MRF\Infrastructure\Persistence\Doctrine\Serializer;

use MRF\Domain\Common\Event\DomainEvent;

interface EventSerializer
{
    public function serialize(DomainEvent $event): string;
}