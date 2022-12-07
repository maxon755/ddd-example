<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Doctrine\Serializer;

class SerializerNotConfigured extends \Exception
{
    public static function create(string $domainEventClass): self
    {
        $message = "Serializer for {$domainEventClass} is not configured";

        return new self($message);
    }
}
