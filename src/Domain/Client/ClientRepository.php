<?php

namespace App\Domain\Client;

use App\Domain\Client\ValueObject\ClientId;

interface ClientRepository
{
    public function save(Client $user): void;

    public function findOneById(ClientId $clientId): ?Client;
}
