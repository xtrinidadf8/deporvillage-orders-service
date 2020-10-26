<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Order;

use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository;

final class OrderRepositoryMock
{
    private $mock;

    public function __construct()
    {
        $this->mock = \Mockery::mock(OrderRepository::class);
    }

    public function getMock(): OrderRepository
    {
        return $this->mock;
    }

    public function shouldPersistAnOrder(Order $order): void
    {
        $this->mock
            ->shouldReceive('save')
            ->once()
            ->withArgs(function (Order $argumentReceived) use ($order) {
                return $argumentReceived->getId()->equals($order->getId());
            })
            ->andReturn();
    }

    public function shouldReturnAnOrderForFindById(Order $order): void
    {
        $this->mock
            ->shouldReceive('findOneById')
            ->once()
            ->withArgs(function ($id) use ($order) {
                return $id === $order->getId()->getValue();
            })
            ->andReturn($order);
    }
}
