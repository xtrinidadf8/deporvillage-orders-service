<?php

declare(strict_types=1);

namespace App\Application\Command\Order;

use App\Application\Command\Command;
use App\Application\Command\InvalidCommandException;

class CreateOrderCommand extends Command
{
    private string $clientId;
    private string $orderId;

    public function __construct(string $orderId, string $clientId)
    {
        if (empty($orderId)) {
            throw new InvalidCommandException('OrderId must not be empty');
        }

        if (empty($clientId)) {
            throw new InvalidCommandException('ClientId must not be empty');
        }

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

    public function getCommandName(): string
    {
        return 'order.create';
    }
}
