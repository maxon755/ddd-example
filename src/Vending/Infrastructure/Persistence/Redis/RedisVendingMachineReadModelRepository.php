<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Redis;

use MacFJA\RediSearch\Redis\Client;
use MacFJA\RediSearch\Redis\Command\Search;
use MacFJA\RediSearch\Redis\Response\PaginatedResponse;
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
        $search = new Search();

        $search
            ->setIndex('idx:vending_machines')
            ->setQuery('*')
        ;

        /** @var PaginatedResponse $response */
        $response = $this->redisearchClient->execute($search);

        $vendingMachines = [];

        foreach ($response as $items) {
            /** @var SearchResponseItem $item */
            foreach ($items as $item) {
                $rawData = (string) $item->getFields()['$'];

                /** @var array{serial_number: string, name:string, address:string} $decodedData */
                $decodedData = json_decode($rawData);

                $vendingMachines[] = $decodedData;
            }
        }

        return $vendingMachines;
    }
}
