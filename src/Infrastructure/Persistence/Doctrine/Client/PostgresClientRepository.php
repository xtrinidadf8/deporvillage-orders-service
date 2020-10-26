<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Client;

use App\Domain\Client\Client;
use App\Domain\Client\ClientRepository;
use App\Domain\Client\ValueObject\ClientId;
use App\Infrastructure\Persistence\Doctrine\Shared\DoctrineRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

final class PostgresClientRepository extends DoctrineRepository implements ClientRepository
{
    public function getClassName(): string
    {
        return Client::class;
    }

    public function save(Client $Client): void
    {
        try {
            $this->em->persist($Client);
            $this->em->flush();
        } catch (OptimisticLockException $e) {
            throw $e;
        } catch (ORMException $e) {
            throw $e;
        }
    }

    public function findOneById(ClientId $clientId): ?Client
    {
        /** @var Client $client */
        $client = $this->repository->findOneBy(['id' => $clientId->getValue()]);

        return $client;
    }
}
