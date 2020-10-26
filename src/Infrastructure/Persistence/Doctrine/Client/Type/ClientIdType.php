<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Client\Type;

use App\Domain\Client\ValueObject\ClientId as DomainUuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

final class ClientIdType extends GuidType
{
    public const TYPE = 'client_id';

    public function getName(): string
    {
        return self::TYPE;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (is_string($value)) {
            return $value;
        }

        return $value->__toString();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): DomainUuid
    {
        return new DomainUuid($value);
    }
}
