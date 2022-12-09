<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Redis;

use MRF\Vending\Application\Query\VendingMachineReadModelRepository;
use Predis\Client;

class RedisVendingMachineReadModelRepository implements VendingMachineReadModelRepository
{
    public function __construct(private Client $redisClient)
    {
    }

    /**
     * @inheritDoc
     */
    public function add(string $vendingMachineId, array $vendingMachineData): void
    {
        $this->redisClient->hmset("vending_machine:{$vendingMachineId}", $vendingMachineData);
    }
}
