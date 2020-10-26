<?php

namespace App\Domain\Order;

use App\Domain\Client\Client;
use App\Domain\Order\Event\OrderCreated;
use App\Domain\Order\ValueObject\OrderId;
use App\Domain\Shared\AggregateRoot;

class Order extends AggregateRoot
{
    private OrderId $id;
    private Client $client;

    public function __construct(OrderId $orderId, Client $client)
    {
        $this->id = $orderId;
        $this->client = $client;
        $this->record(new OrderCreated());
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
