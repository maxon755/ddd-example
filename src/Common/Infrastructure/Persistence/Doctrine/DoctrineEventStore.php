<?php

declare(strict_types=1);

namespace MRF\Common\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MRF\Common\Domain\Event\DomainEvent;
use MRF\Common\Domain\Event\EventStore;
use MRF\Common\Domain\Event\StoredEvent;
use MRF\Common\Infrastructure\Persistence\Doctrine\Serializer\EventSerializerFactory;
use MRF\Common\Infrastructure\Persistence\Doctrine\Serializer\SerializerNotConfigured;

/**
 * @extends ServiceEntityRepository<StoredEvent>
 */
class DoctrineEventStore extends ServiceEntityRepository implements EventStore
{
    public function __construct(
        ManagerRegistry $registry,
        private EventSerializerFactory $serializerFactory,
    ) {
        parent::__construct($registry, StoredEvent::class);
    }

    /**
     * @throws SerializerNotConfigured
     */
    public function append(DomainEvent $event): void
    {
        $serializer = $this->serializerFactory->getSerializerForEvent($event::class);

        $storedEvent = new StoredEvent(
            $event::class,
            $serializer->serialize($event),
            $event->getOccurredAt()
        );

        $this->getEntityManager()->persist($storedEvent);
    }
}
