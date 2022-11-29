<?php

declare(strict_types=1);

namespace MRF\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use MRF\Domain\Common\Event\DomainEvent;
use MRF\Domain\Common\Event\EventStore;
use MRF\Domain\Common\Event\StoredEvent;
use MRF\Infrastructure\Persistence\Doctrine\Serializer\EventSerializerFactory;
use MRF\Infrastructure\Persistence\Doctrine\Serializer\SerializerNotConfigured;

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
