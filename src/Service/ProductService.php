<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductService
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly ImageService $imageService,
    )
    {}

    function addProduct(string $name, string $description, int $price, UploadedFile $image, ?string $section): ?int
    {
        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setDescription($description);
        if ($section !== null && $section !== '') {
            $product->setSection($section);
        }
        if (!$imageFileName = $this->imageService->uploadFile($image)) {

        }
        $product->setImage($imageFileName);
        return $this->productRepository->store($product);
    }

    function findProduct(int $id): ?Product {
        return $this->productRepository->find($id);
    }

    function listProducts(): ?array {
        return $this->productRepository->findAll();
    }

    function listProductsOrderBySections(): ?array {
        $res = [];
        foreach ($this->listProducts() as $product) {
            $res[$product->getSection()][] = $product;
        }
        return $res;
    }
}