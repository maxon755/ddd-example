<?php

declare(strict_types=1);

namespace MRF\Application\Vending\VendingMachine\CreateVendingMachineService;

class CreateVendingMachineRequest
{
    public function __construct(
        private $serialNumber,
        private $name,
        private $address,
        private $operatorPhone,
    ) {
    }

    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getOperatorPhone()
    {
        return $this->operatorPhone;
    }
}
