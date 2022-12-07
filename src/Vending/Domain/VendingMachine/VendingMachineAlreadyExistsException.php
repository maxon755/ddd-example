<?php

declare(strict_types=1);

namespace MRF\Vending\Domain\VendingMachine;

class VendingMachineAlreadyExistsException extends \Exception
{
    public static function create(SerialNumber $serialNumber): self
    {
        $message = "Vending machine with {$serialNumber->serialNumber} already exists";

        return new self($message);
    }
}
