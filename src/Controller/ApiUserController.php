<?php

namespace App\Controller;

use App\Service\PasswordHasher;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiUserController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
        private readonly PasswordHasher $passwordHasher,
    )
    {
    }
    public function get(int $id): ?Response
    {
        $user = $this->userService->findUser($id);
        if (null === $user) {
            return $this->json([],
                Response::HTTP_OK,
                ['Content-Type' => 'application/json']
            );
        }
        return $this->json($user, Response::HTTP_OK);
    }

    public function register(Request $request): Response
    {
        if ($this->userService->findUserByEmail($request->get('email')) !== null) {
            return $this->json([], Response::HTTP_CONFLICT);
        }
        $this->userService->addUser(
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('email'),
            $this->passwordHasher->hash($request->get('password')),
            $request->get('phone')
        );
        return $this->json(null, Response::HTTP_CREATED);
    }

    public function login(Request $request): Response {
        $user = $this->userService->findUserByEmail($request->get('email'));
        if (
            $user !== null
            && $this->passwordHasher->verify($user->getPassword(), $request->get('password'))
        ) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['id'] = $user->getId();
            return $this->json([], Response::HTTP_OK);
        }
        return $this->json([], Response::HTTP_UNAUTHORIZED);
    }
}