<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Client;

use App\Domain\Client\Client;
use App\Domain\Client\ClientRepository;

final class ClientRepositoryMock
{
    private $mock;

    public function __construct()
    {
        $this->mock = \Mockery::mock(ClientRepository::class);
    }

    public function getMock(): ClientRepository
    {
        return $this->mock;
    }

    public function shouldPersistAClient(Client $client): void
    {
        $this->mock
            ->shouldReceive('save')
            ->once()
            ->withArgs(function (Client $argumentReceived) use ($client) {
                return $argumentReceived->getId()->equals($client->getId());
            })
            ->andReturn();
    }

    public function shouldReturnAClientForFindById(Client $client): void
    {
        $this->mock
            ->shouldReceive('findOneById')
            ->once()
            ->withArgs(function ($id) use ($client) {
                return $id === $client->getId()->getValue();
            })
            ->andReturn($client);
    }

    public function shouldReturnNullForFindById(Client $client): void
    {
        $this->mock
            ->shouldReceive('findOneById')
            ->once()
            ->withArgs(function ($id) use ($client) {
                return $id !== $client->getId()->getValue();
            })
            ->andReturn(null);
    }
}
