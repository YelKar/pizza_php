<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartService;
use App\Service\ProductService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{
    public function __construct(
        private readonly CartService $cartService,
        private readonly UserService $userService,
        private readonly ProductService $productService,
    )
    {
    }

    public function showCart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_name("sid");
            session_start();
        }
        if (isset($_SESSION['id'])) {
            return $this->render('cart/index.html.twig', ["cart" => $this->cartService->getAll($_SESSION["id"])]);
        }
        return new Response("Unauthorized access", Response::HTTP_UNAUTHORIZED);
    }

    public function addProduct(int $id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_name("sid");
            session_start();
        }
        if (isset($_SESSION['id'])) {
            $product = $this->productService->findProduct($id);
            var_dump($product);
            if ($product !== null) {
                $this->cartService->add($_SESSION['id'], $product);
                return new Response("Product added to cart", Response::HTTP_OK);
            }
            return new Response("Invalid product id", Response::HTTP_BAD_REQUEST);
        }
        return new Response("Unauthorized access", Response::HTTP_UNAUTHORIZED);
    }
}