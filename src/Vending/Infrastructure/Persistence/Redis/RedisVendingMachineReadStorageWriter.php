<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Redis;

use MRF\Vending\Application\Event\VendingMachineReadStorageWriter;

class RedisVendingMachineReadStorageWriter implements VendingMachineReadStorageWriter
{
    public function __construct(private \Redis $client)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function add(string $vendingMachineId, array $vendingMachineData): void
    {
        $this->client->rawCommand(
            'JSON.SET',
            "vending_machine:{$vendingMachineId}",
            '$',
            json_encode($vendingMachineData)
        );

//        $this->client->hmset("vending_machine:{$vendingMachineId}", $vendingMachineData);
    }
}
