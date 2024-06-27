<?php

namespace App\Controller;

use App\Controller\Input\RegisterUserInput;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService
    )
    {}

    public function register(Request $request): Response
    {
        $input = new RegisterUserInput();
        $form = $this->createForm(RegisterUserInput::class, $input, [
            'action' => $this->generateUrl('register'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $input = $form->getData();
            $this->userService->register($input);

            return $this->redirectToRoute('login');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function updateUser(Request $request, int $id): Response
    {
        $this->userService->updateUser(
            $id,
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('phone'),
            $request->get('email'),
        );
        return $this->redirectToRoute('show_user', ['id' => $id]);
    }

    public function showUser(int $id): Response
    {
        $user = $this->userService->findUser($id);
        return $this->render('user/show.html.twig', ["user" => $user]);
    }

    public function listUsers(Request $request): Response {
        $users = $this->userService->listUsers();
        return $this->render('user/list.html.twig', ["users" => $users]);
    }
}
