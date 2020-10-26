<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Shared;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class DoctrineRepository
{
    protected EntityManagerInterface $em;
    protected ObjectRepository $repository;
    //TODO Add Logger

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        /** @var class-string $className */
        $className = $this->getClassName();
        $this->repository = $this->em->getRepository($className);
    }

    abstract public function getClassName(): string;
}
