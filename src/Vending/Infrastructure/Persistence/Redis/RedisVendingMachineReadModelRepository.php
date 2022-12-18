<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Redis;

use MacFJA\RediSearch\Redis\Client;
use MacFJA\RediSearch\Redis\Response\SearchResponseItem;
use MRF\Vending\Application\Query\VendingMachineReadModelRepository;

class RedisVendingMachineReadModelRepository implements VendingMachineReadModelRepository
{
    public function __construct(private Client $redisearchClient)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function findAll(): array
    {
        $search = new \MacFJA\RediSearch\Redis\Command\Search();

        $search
            ->setIndex('idx:vending_machines')
            ->setQuery('*')
        ;

        /** @var iterable $response */
        $response = $this->redisearchClient->execute($search);

        $vendingMachines = [];

        foreach ($response as $items) {
            /** @var SearchResponseItem $item */
            foreach ($items as $item) {
                $vendingMachines[] = $item->getFields();
            }
        }

        return $vendingMachines;
    }
}
