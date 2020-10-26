<?php

declare(strict_types=1);

namespace App\Application\Event\Order;

use App\Application\Event\EventBusHandler;
use App\Domain\Order\Event\OrderCreated;

class OrderCreatedHandler implements EventBusHandler
{
    public function __invoke(OrderCreated $event): void
    {
        // TODO: Send an email to PO, for example
    }
}
