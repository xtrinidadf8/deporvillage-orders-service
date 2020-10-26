<?php

declare(strict_types=1);

namespace Tests\integration\Infrastucture\Persistance\Doctrine\Order;

use App\Domain\Order\Order;
use App\Infrastructure\Persistence\Doctrine\Order\PostgresOrderRepository;
use Doctrine\ORM\EntityManager;
use Tests\integration\IntegrationTestCase;
use Tests\unit\ObjectMother\Order\OrderMother;

/**
 * @group integration
 */
final class PostgresOrderRepositoryTest extends IntegrationTestCase
{
    private PostgresOrderRepository $orderRepository;
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderRepository = $this->service('App\Infrastructure\Persistence\Doctrine\Order\PostgresOrderRepository');
        $this->entityManager = $this->service('doctrine.orm.entity_manager');
        $this->entityManager->getConnection()->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->clearUnitOfWork();
        $this->entityManager->getConnection()->rollback();
        parent::tearDown();
    }

    /** @test */
    public function it_should_get_a_order_by_id(): void
    {
        $order = OrderMother::random();
        $this->orderRepository->save($order);

        $savedOrder = $this->entityManager
            ->getRepository(Order::class)
            ->findOneBy(['id' => $order->getId()]);

        $this->assertEquals($order, $savedOrder);
    }
}
