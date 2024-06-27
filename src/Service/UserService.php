<?php

namespace App\Service;

use App\Controller\Input\RegisterUserInput;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Input\RegisterUserInputInterface;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PasswordHasher $passwordHasher,
    )
    {

    }
    public function addUser(string $firstName, string $lastName, string $email, string $password, string $phone): int
    {
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setPhone($phone);
        $user->setEmail($email);
        $user->setPassword($password);

        return $this->userRepository->store($user);
    }

    public function register(RegisterUserInputInterface $input): int {
        $user = $this->findUserByEmail($input->getEmail());
        if ($user !== null) {
            throw new \InvalidArgumentException('User already exists.');
        }
        return $this->addUser(
            $input->getFirstName(),
            $input->getLastName(),
            $input->getEmail(),
            $this->passwordHasher->hash($input->getPassword()),
            $input->getPhone(),
        );
    }
    public function updateUser(int $id, string $firstName, string $lastName, string $phone, string $email): int
    {
        $user = $this->userRepository->find($id);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setPhone($phone);
        $user->setEmail($email);

        return $this->userRepository->store($user);
    }

    public function findUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function findUser(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function listUsers(): array
    {
        return $this->userRepository->findAll();
    }
}