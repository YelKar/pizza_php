<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends AbstractController
{
    public function __construct(
        private readonly UserService  $userService,
    )
    {}

    public function login(Request $request): Response
    {
        return $this->render('user/login.html.twig', []);
    }

    public function logout(): Response
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        session_destroy();
        $_SESSION = [];
        return $this->redirectToRoute('index');
    }

    public function authUser(Request $request): Response {
        $email = $request->get('email');
        $user = $this->userService->findUserByEmail($email);
        if(!isset($_SESSION))
        {
            session_start();
        }
        var_dump(session_status());
        $_SESSION["id"] = $user->getId();
        $_SESSION["role"] = $user->getRole();
        var_dump($_SESSION);
        return $this->redirectToRoute('index');
    }
}