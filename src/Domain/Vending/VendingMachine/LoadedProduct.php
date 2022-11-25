<?php

declare(strict_types=1);

namespace MRF\Domain\Vending\VendingMachine;

class LoadedProduct
{
    public function __construct(
        private VendingMachine $vendingMachine,
        private int $baseAmount,
        private int $currentAmount,
        private int $priceDelta,
    ) {
    }
}
