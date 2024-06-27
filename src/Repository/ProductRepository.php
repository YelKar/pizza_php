<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;


class ProductRepository
{
    private EntityRepository $repository;
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Product::class);
    }

    public function store(Product $product): int
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return $product->getId();
    }

    public function delete(Product $product): void
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    public function find(int $id): Product
    {
        return $this->entityManager->find(Product::class, $id);
    }

    public function findAll(): array {
        return $this->repository->findAll();
    }
}
