<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\UI\CLI;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'vending-machine:redis:setup')]
class CreateVendingMachineRedisearchIndex extends Command
{
    public function __construct(private \Redis $client)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $indexName = 'idx:vending_machines';

        try {
            $this->client->rawCommand('FT.DROPINDEX', $indexName);
        } catch (\RedisException $exception) {
            if ('Unknown Index name' !== $exception->getMessage()) {
                $output->writeln("<error>{$exception->getMessage()}</error>");

                return self::FAILURE;
            }
        }

        $arguments = explode(
            ' ',
            "{$indexName} ON JSON " .
                'PREFIX 1 vending_machine: ' .
                'SCHEMA ' .
                '$.serial_number AS serial_number TEXT ' .
                '$.name AS name TEXT ' .
                '$.address AS address TEXT'
        );

//        FT.CREATE userIdx ON JSON SCHEMA $.user.name AS name TEXT $.user.email AS email  TAG
        $this->client->rawCommand('FT.CREATE', ...$arguments);

        $output->writeln("<info>Index {$indexName} was successfully created</info>");

        return self::SUCCESS;
    }
}
