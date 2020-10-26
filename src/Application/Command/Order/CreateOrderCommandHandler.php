<?php

declare(strict_types=1);

namespace App\Application\Command\Order;

use App\Application\Command\CommandBusHandler;
use App\Application\UseCase\Order\CreateOrderUseCase;
use App\Application\UseCase\Order\CreateOrderUseCaseDTO;
use App\Domain\Client\ValueObject\ClientId;
use App\Domain\Order\ValueObject\OrderId;
use Throwable;

class CreateOrderCommandHandler implements CommandBusHandler
{
    private CreateOrderUseCase $useCase;

    public function __construct(CreateOrderUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(CreateOrderCommand $command): void
    {
        try {
            // Start transaction
            $this->useCase->__invoke(
                new CreateOrderUseCaseDTO(
                    new OrderId($command->getOrderId()),
                    new ClientId($command->getClientId())
                )
            );
            // Commit transaction
        } catch (Throwable $exception) {
            // Rollback transaction
            // Throw exception
        }
    }
}
