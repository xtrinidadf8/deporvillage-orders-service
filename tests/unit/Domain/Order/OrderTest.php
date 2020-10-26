<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Order;

use App\Domain\Order\Event\OrderCreated;
use Tests\unit\ObjectMother\Order\OrderMother;
use Tests\unit\UnitTestCase;

class OrderTest extends UnitTestCase
{
    public function testOrderEvent()
    {
        $order = OrderMother::random();
        $this->assertDomainEventIsRecorded($order, OrderCreated::class);
    }
}
