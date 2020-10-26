<?php

declare(strict_types=1);

namespace Tests\integration\Infrastucture\Persistance\Doctrine\Client;

use App\Domain\Client\Client;
use App\Infrastructure\Persistence\Doctrine\Client\PostgresClientRepository;
use Doctrine\ORM\EntityManager;
use Tests\integration\IntegrationTestCase;
use Tests\unit\ObjectMother\Client\ClientMother;

/**
 * @group integration
 */
final class PostgresClientRepositoryTest extends IntegrationTestCase
{
    private PostgresClientRepository $clientRepository;
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->clientRepository = $this->service('App\Infrastructure\Persistence\Doctrine\Client\PostgresClientRepository');
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
    public function it_should_get_a_client_by_id(): void
    {
        $client = ClientMother::random();
        $this->clientRepository->save($client);

        $savedClient = $this->entityManager
            ->getRepository(Client::class)
            ->findOneBy(['id' => $client->getId()]);

        $this->assertEquals($client, $savedClient);
    }
}
