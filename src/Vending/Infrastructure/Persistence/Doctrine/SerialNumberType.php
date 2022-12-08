<?php

declare(strict_types=1);

namespace MRF\Vending\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use MRF\Vending\Domain\VendingMachine\SerialNumber;

class SerialNumberType extends Type
{

    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return $platform->getStringTypeDeclarationSQL([
            'length' => SerialNumber::LENGTH,
        ]);
    }

    public function getName(): string
    {
        return 'SerialNumber';
    }

    /**
     * @param SerialNumber $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return (string) $value;
    }

    /**
     * @param string $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): SerialNumber
    {
        return new SerialNumber($value);
    }

}
