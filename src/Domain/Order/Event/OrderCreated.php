<?php

declare(strict_types=1);

namespace App\Domain\Order\Event;

use App\Domain\Shared\Event\DomainEvent;

class OrderCreated extends DomainEvent
{
    public function getEventName(): string
    {
        return 'order.created';
    }
}
