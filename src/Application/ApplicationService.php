<?php

declare(strict_types=1);

namespace MRF\Application;

interface ApplicationService
{
    /** @phpstan-ignore-next-line */
    public function execute($request);
}
