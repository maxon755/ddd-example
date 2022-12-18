<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\UI\Http\Controller;

use League\Tactician\CommandBus;
use MRF\Vending\Application\Command\VendingMachine\CreateVendingMachine\CreateVendingMachineCommand;
use MRF\Vending\Application\Query\VendingMachine\FindAllVendingMachinesQuery;
use MRF\Vending\Application\Query\VendingMachine\FindAllVendingMachinesQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendingMachineController extends AbstractController
{
    #[Route('/api/vending-machines', name: 'vending-machine.create', methods: ['POST'])]
    public function create(CommandBus $commandBus): Response
    {
        $command = new CreateVendingMachineCommand(
            (string) random_int(1111222233334445, 9111222233334445),
            'test2',
            'test street 142',
        );

        $commandBus->handle($command);

        return new Response('Vending machine created');
    }

    #[Route('/api/vending-machines', name: 'vending-machine.index', methods: ['GET'])]
    public function index(FindAllVendingMachinesQueryHandler $queryHandler): Response
    {
        $vendingMachines = $queryHandler->handle(new FindAllVendingMachinesQuery());

        return new JsonResponse($vendingMachines);
    }
}
