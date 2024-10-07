<?php

namespace Src\Service;

use Src\Repository\UserRepository;
use Src\Service\UserServiceInterface;

class UserService implements UserServiceInterface
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function auth(string $login, string $password): string
    {
        return json_encode(
            $this->userRepository->auth($login, $password)
        );
    }

    public function getUser(int $userId): string
    {
        return json_encode(
            $this->userRepository->getUser($userId)
        );
    }

    public function updateUser(int $userId, array $data): string
    {
        return json_encode(
            $this->userRepository->updateUser($userId, $data)
        );
    }
}