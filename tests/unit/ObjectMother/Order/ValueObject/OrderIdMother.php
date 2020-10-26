<?php

declare(strict_types=1);

namespace Tests\unit\ObjectMother\Order\ValueObject;

use App\Domain\Order\ValueObject\OrderId;

class OrderIdMother
{
    public static function random(): OrderId
    {
        return OrderId::random();
    }
}
