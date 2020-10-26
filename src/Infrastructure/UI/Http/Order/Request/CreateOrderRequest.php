<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Http\Order\Request;

use App\Infrastructure\UI\Http\HttpRequest;

class CreateOrderRequest implements HttpRequest
{
    private string $clientId;
    private string $orderId;

    public function __construct(string $orderId, string $clientId)
    {
        $this->clientId = $clientId;
        $this->orderId = $orderId;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}
