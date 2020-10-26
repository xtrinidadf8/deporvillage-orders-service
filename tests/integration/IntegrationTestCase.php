<?php

declare(strict_types=1);

namespace Tests\integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    /** @return mixed */
    protected function service($id)
    {
        return self::$container->get($id);
    }

    /** @return mixed */
    protected function parameter($parameter)
    {
        return self::$container->getParameter($parameter);
    }

    protected function clearUnitOfWork(): void
    {
        $this->service('doctrine.orm.default_entity_manager')->clear();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
