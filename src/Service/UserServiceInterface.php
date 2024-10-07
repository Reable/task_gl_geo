<?php 

namespace Src\Service;

interface UserServiceInterface
{
    public function auth(string $login, string $password): string;

    public function getUser(int $userId): string;

    public function updateUser(int $userId, array $data): string;
}