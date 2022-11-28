<?php

declare(strict_types=1);

namespace MRF\Infrastructure\Transaction;

use MRF\Application\ApplicationService;
use MRF\Application\TransactionalSession;

class TransactionalApplicationService implements ApplicationService
{
    public function __construct(
        private ApplicationService $applicationService,
        private TransactionalSession $transactionalSession,
    ) {
    }

    public function execute(mixed $request): mixed
    {
        $operation = function () use ($request) {
            return $this->applicationService->execute($request);
        };

        return $this->transactionalSession->execute($operation);
    }
}
