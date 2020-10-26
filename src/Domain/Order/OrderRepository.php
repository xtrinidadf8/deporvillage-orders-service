<?php

namespace App\Domain\Order;

use App\Domain\Order\ValueObject\OrderId;

interface OrderRepository
{
    public function save(Order $order): void;

    public function findOneById(OrderId $orderId): ?Order;
}
