<?php

declare(strict_types=1);

namespace App\Domain\Client\Exception;

use App\Domain\Shared\Exception\Exception;

class InvalidClientIdException extends Exception
{
    public function __construct(string $clientId)
    {
        parent::__construct('Invalid client id: '.$clientId);
    }
}
