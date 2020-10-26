<?php

declare(strict_types=1);

namespace Tests\unit\Domain\Shared\Event;

use App\Application\Event\EventBus;
use App\Domain\Shared\Event\DomainEvent;

final class EventBusMock
{
    private $mock;

    public function __construct()
    {
        $this->mock = \Mockery::mock(EventBus::class);
    }

    public function getMock(): EventBus
    {
        return $this->mock;
    }

    public function shouldPublishOneEvent(DomainEvent $domainEvent): void
    {
        $this->mock
            ->shouldReceive('publish')
            ->once()
            ->withArgs(
                function (DomainEvent $domainEventExpected) use ($domainEvent) {
                    return $domainEventExpected->aggregateId() === $domainEvent->aggregateId();
                }
            );
    }
}
