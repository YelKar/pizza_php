<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\User;
use Redis;

class CartService
{

    private readonly \Redis $db;
    public function __construct(
        private readonly ProductService $productService,
    )
    {
        $this->db = new Redis();
        $this->db->connect('127.0.0.1', 6379);
    }
    public function add(int $user_id, Product $product): void
    {
        $cart = $this->getAllProductIds($user_id);
        $cart[] = $product->getId();

        $this->db->set($user_id, implode(',', $cart));
    }
    public function remove(Product $product): void
    {

    }
    public function clear(): void
    {

    }
    private function getAllProductIds(int $user_id): array
    {
        $cart = $this->db->get($user_id);
        return $cart ? explode(',', $cart) : [];
    }
    public function getAll(int $user_id): array
    {
        $cartIds = array_count_values($this->getAllProductIds($user_id));
        $cart = [];
        foreach ($cartIds as $product_id => $count) {
            $cart[] = ["count" => $count, "product" => $this->productService->findProduct($product_id)];
        }
        return $cart;
    }
}