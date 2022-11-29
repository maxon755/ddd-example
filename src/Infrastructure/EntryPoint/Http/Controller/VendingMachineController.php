<?php

declare(strict_types=1);

namespace MRF\Infrastructure\EntryPoint\Http\Controller;

use League\Tactician\CommandBus;
use MRF\Application\Vending\VendingMachine\CreateVendingMachine\CreateVendingMachineCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendingMachineController extends AbstractController
{
    #[Route('/api/vending-machines', name: 'vending-machine.create', methods: ['POST'])]
    public function create(CommandBus $commandBus): Response
    {
        $command = new CreateVendingMachineCommand(
            '1111222233334444',
            'test',
            'test street 142',
        );

        $commandBus->handle($command);

        return new Response();
    }
}