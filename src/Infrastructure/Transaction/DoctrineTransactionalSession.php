<?php

declare(strict_types=1);

namespace MRF\Infrastructure\Transaction;

use Doctrine\ORM\EntityManagerInterface;
use MRF\Application\TransactionalSession;

class DoctrineTransactionalSession implements TransactionalSession
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @return mixed
     *
     * @throws \Throwable
     */
    public function execute(callable $operation)
    {
        return $this->entityManager->wrapInTransaction($operation);
    }
}
