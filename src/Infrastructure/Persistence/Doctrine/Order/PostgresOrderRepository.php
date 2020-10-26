<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Order;

use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository;
use App\Domain\Order\ValueObject\OrderId;
use App\Infrastructure\Persistence\Doctrine\Shared\DoctrineRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

final class PostgresOrderRepository extends DoctrineRepository implements OrderRepository
{
    public function getClassName(): string
    {
        return Order::class;
    }

    public function save(Order $order): void
    {
        try {
            $this->em->persist($order->getClient());
            $this->em->persist($order);

            $this->em->flush();
        } catch (OptimisticLockException $e) {
            throw $e;
        } catch (ORMException $e) {
            throw $e;
        }
    }

    public function findOneById(OrderId $orderId): ?Order
    {
        /** @var Order $order */
        $order = $this->repository->findOneBy(['id' => $orderId->getValue()]);

        return $order;
    }
}
