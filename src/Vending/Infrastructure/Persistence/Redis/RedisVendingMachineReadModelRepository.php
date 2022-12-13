<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Redis;

use MRF\Vending\Application\Query\VendingMachineReadModelRepository;

class RedisVendingMachineReadModelRepository implements VendingMachineReadModelRepository
{
    public function __construct(private \Redis $redisClient)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function add(string $vendingMachineId, array $vendingMachineData): void
    {
        $this->redisClient->hmset("vending_machine:{$vendingMachineId}", $vendingMachineData);
    }
}
