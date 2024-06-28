<?php

namespace App\Controller;

use App\Service\JsonResponseService;
use App\Service\ProductService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\String\s;

class ProductController extends AbstractController
{

    public function __construct(
        private readonly ProductService $productService,
        private readonly UserService $userService,
        private readonly JsonResponseService $jsonResponseService
    )
    {}

    public function index(): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_name("sid");
            session_start();
        }
        $sections = $this->productService->listProductsOrderBySections();
        if (($_SESSION['id'] ?? null) === null) {
            return $this->render('product/index.html.twig', ["sections" => $sections]);
        }
        $user = $this->userService->findUser($_SESSION['id']);
        return $this->render('product/index.html.twig', ["sections" => $sections, "user" => $user]);
    }

    public function showProduct(int $id): Response {
        $product = $this->productService->findProduct($id);
        return $this->render('product/show.html.twig', ["product" => $product]);
    }

    public function getProductJson(int $id): Response
    {
        $product = $this->productService->findProduct($id);
        return $this->json($product, 200, ["Content-Type" => "application/json"]);
    }

    public function newProduct(Request $request): Response {
        if(!isset($_SESSION))
        {
            session_name("sid");
            session_start();
        }
        if (!(isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == "ADMIN")) {
            return $this->redirectToRoute('index');
        }
        return $this->render('product/add.html.twig');
    }

    public function addProduct(Request $request): Response {
        if(!isset($_SESSION))
        {
            session_name("sid");
            session_start();
        }
        if (!(isset($_SESSION['id']) && isset($_SESSION['role']) && $_SESSION['role'] == "ADMIN")) {
            return $this->redirectToRoute('index');
        }

        $id = $this->productService->addProduct(
            $request->get('name'),
            $request->get('description'),
            $request->get('price'),
            $request->files->get('image'),
            $request->get('section'),
        );

        return $this->redirectToRoute('show_product', ["id" => $id]);
    }
}
