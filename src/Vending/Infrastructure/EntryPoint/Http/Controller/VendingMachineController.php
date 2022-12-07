<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\EntryPoint\Http\Controller;

use League\Tactician\CommandBus;
use MRF\Vending\Application\VendingMachine\CreateVendingMachine\CreateVendingMachineCommand;
use MRF\Domain\Common\Event\DomainEventPublisher;
use MRF\Vending\Infrastructure\DomainSubscriber\SyncVendingMachineInMemorySubscriber;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendingMachineController extends AbstractController
{
    #[Route('/api/vending-machines', name: 'vending-machine.create', methods: ['POST'])]
    public function create(CommandBus $commandBus, SyncVendingMachineInMemorySubscriber $inMemorySubscriber): Response
    {
        DomainEventPublisher::instance()->subscribe($inMemorySubscriber);

        $command = new CreateVendingMachineCommand(
            '1111222233334445',
            'test2',
            'test street 142',
        );

        $commandBus->handle($command);

        return new Response();
    }
}
