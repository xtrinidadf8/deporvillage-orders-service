<?php

namespace Tests\unit\ObjectMother\Order;

use App\Domain\Order\Order;
use Tests\unit\ObjectMother\Client\ClientMother;
use Tests\unit\ObjectMother\Order\ValueObject\OrderIdMother;

class OrderMother
{
    public static function random(): Order
    {
        return new Order(
            OrderIdMother::random(),
            ClientMother::random()
        );
    }
}
