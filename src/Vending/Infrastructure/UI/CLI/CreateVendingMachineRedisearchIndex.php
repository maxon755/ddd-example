<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\UI\CLI;

use MacFJA\RediSearch\Index;
use MacFJA\RediSearch\IndexBuilder;
use MacFJA\RediSearch\Redis\Client;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'vending-machine:redis:setup')]
class CreateVendingMachineRedisearchIndex extends Command
{
    public function __construct(private Client $client)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $indexName = 'idx:vending_machines';

        $index = new Index($indexName, $this->client);
        $index->delete();

        $indexBuilder = new IndexBuilder();
        $indexBuilder
            ->setIndex('idx:vending_machines')
            ->setPrefixes(['vending_machine:'])
            ->addTextField('serial_number')
            ->addTextField('name')
            ->addTextField('address')
            ->create($this->client)
        ;

        $output->writeln("<info>Index {$indexName} was successfully created</info>");

        return self::SUCCESS;
    }
}
