<?php

namespace App\Domain\Client;

use App\Domain\Client\ValueObject\ClientId;
use App\Domain\Shared\AggregateRoot;

class Client extends AggregateRoot
{
    private ClientId $id;
    private string $email;

    public function __construct(ClientId $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function getId(): ClientId
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
