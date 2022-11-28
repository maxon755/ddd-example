<?php

declare(strict_types=1);

namespace MRF\Application;

interface TransactionalSession
{
    /** @phpstan-ignore-next-line */
    public function execute(callable $operation);
}
