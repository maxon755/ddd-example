<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\UI\Http\Controller;

use League\Tactician\CommandBus;
use MRF\Vending\Application\VendingMachine\CreateVendingMachine\CreateVendingMachineCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendingMachineController extends AbstractController
{
    #[Route('/api/vending-machines', name: 'vending-machine.create', methods: ['POST'])]
    public function create(CommandBus $commandBus): Response
    {
        $command = new CreateVendingMachineCommand(
            '1111222233334445',
            'test2',
            'test street 142',
        );

        $commandBus->handle($command);

        return new Response();
    }
}
