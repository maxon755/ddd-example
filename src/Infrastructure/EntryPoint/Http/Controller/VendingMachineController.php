<?php

declare(strict_types=1);

namespace MRF\Infrastructure\EntryPoint\Http\Controller;

use MRF\Application\TransactionalSession;
use MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineRequest;
use MRF\Application\Vending\VendingMachine\CreateVendingMachineService\CreateVendingMachineService;
use MRF\Infrastructure\Transaction\TransactionalApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendingMachineController extends AbstractController
{
    #[Route('/vending-machines', name: 'vending-machine.create', methods: ['GET'])]
    public function create(
        CreateVendingMachineService $service,
        TransactionalSession $transactionalSession
    ): Response {
        $service = new TransactionalApplicationService(
            $service,
            $transactionalSession
        );

        $service->execute(new CreateVendingMachineRequest(
            '1111222233334444',
            'test',
            'test street 142',
        ));

        return new Response();
    }
}
