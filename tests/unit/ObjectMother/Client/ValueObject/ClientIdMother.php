<?php

declare(strict_types=1);

namespace Tests\unit\ObjectMother\Client\ValueObject;

use App\Domain\Client\ValueObject\ClientId;

class ClientIdMother
{
    public static function random(): ClientId
    {
        return ClientId::random();
    }
}
