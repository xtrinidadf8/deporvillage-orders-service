<?php

declare(strict_types=1);

namespace App\Application\UseCase\Order;

use App\Application\Event\EventBus;
use App\Domain\Client\ClientRepository;
use App\Domain\Client\Exception\InvalidClientIdException;
use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository;

class CreateOrderUseCase
{
    private OrderRepository $orderRepository;
    private ClientRepository $clientRepository;
    private EventBus $eventBus;

    public function __construct(OrderRepository $orderRepository, ClientRepository $clientRepository, EventBus $eventBus)
    {
        $this->orderRepository = $orderRepository;
        $this->clientRepository = $clientRepository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateOrderUseCaseDTO $dto): void
    {
        $clientId = $dto->getClientId();
        $client = $this->clientRepository->findOneById($clientId);

        if (empty($client)) {
            throw new InvalidClientIdException($clientId->getValue());
        }

        $order = new Order(
            $dto->getOrderId(),
            $client
        );
        $this->orderRepository->save($order);
        $this->eventBus->publish(...$order->pullDomainEvents());
    }
}
