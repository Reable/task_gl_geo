<?php 

namespace Src\Repository;

use Exception;

interface UserRepositoryInterface
{
    
    public function auth(string $login, string $password): array;

    public function getUser(int $userId): array;

    public function updateUser(int $userId, array $data): array;

}