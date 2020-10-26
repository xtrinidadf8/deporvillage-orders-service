<?php

declare(strict_types=1);

namespace App\Application\UseCase\Order;

use App\Domain\Client\ValueObject\ClientId;
use App\Domain\Order\ValueObject\OrderId;

class CreateOrderUseCaseDTO
{
    private ClientId $clientId;
    private OrderId $orderId;

    public function __construct(OrderId $orderId, ClientId $clientId)
    {
        $this->clientId = $clientId;
        $this->orderId = $orderId;
    }

    public function getClientId(): ClientId
    {
        return $this->clientId;
    }

    public function getOrderId(): OrderId
    {
        return $this->orderId;
    }
}
