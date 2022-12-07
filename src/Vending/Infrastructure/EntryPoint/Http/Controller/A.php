<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\EntryPoint\Http\Controller;

class A
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
