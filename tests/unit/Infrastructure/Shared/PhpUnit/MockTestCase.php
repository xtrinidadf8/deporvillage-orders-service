<?php

declare(strict_types=1);

namespace Tests\unit\Infrastructure\Shared\PhpUnit;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

abstract class MockTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function tearDown(): void
    {
        $this->closeMockery();
        parent::tearDown();
    }
}
