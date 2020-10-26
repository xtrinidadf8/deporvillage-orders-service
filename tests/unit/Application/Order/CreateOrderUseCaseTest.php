<?php

declare(strict_types=1);

namespace Tests\unit\Application\Order;

use App\Application\UseCase\Order\CreateOrderUseCase;
use App\Application\UseCase\Order\CreateOrderUseCaseDTO;
use App\Domain\Client\Exception\InvalidClientIdException;
use Tests\unit\Domain\Client\ClientRepositoryMock;
use Tests\unit\Domain\Order\OrderRepositoryMock;
use Tests\unit\Domain\Shared\Event\EventBusMock;
use Tests\unit\Infrastructure\Shared\PhpUnit\MockTestCase;
use Tests\unit\ObjectMother\Client\ValueObject\ClientIdMother;
use Tests\unit\ObjectMother\Order\OrderMother;

class CreateOrderUseCaseTest extends MockTestCase
{
    private CreateOrderUseCase $createOrderService;
    private OrderRepositoryMock $orderRepository;
    private ClientRepositoryMock $clientRepository;
    private EventBusMock $eventBus;

    protected function setUp(): void
    {
        $this->orderRepository = new OrderRepositoryMock();
        $this->clientRepository = new ClientRepositoryMock();
        $this->eventBus = new EventBusMock();

        $this->createOrderService = new CreateOrderUseCase(
            $this->orderRepository->getMock(),
            $this->clientRepository->getMock(),
            $this->eventBus->getMock()
        );
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /** @test */
    public function it_should_throw_invalid_client_id_if_is_not_valid(): void
    {
        $order = OrderMother::random();
        $unpersistedClientId = ClientIdMother::random();
        $client = $order->getClient();

        $this->clientRepository->shouldReturnNullForFindById($client);
        $this->expectException(InvalidClientIdException::class);
        $this->expectExceptionMessage("Invalid client id: $unpersistedClientId");

        $this->createOrderService->__invoke(
            new CreateOrderUseCaseDTO(
                $order->getId(),
                $unpersistedClientId
            )
        );
    }
}
