<?php

require __DIR__ . '/../vendor/autoload.php';

use Src\Factory\UserFactory;
use Src\Service\UserService;

$userRepository = UserFactory::createRepository();
$userService = new UserService($userRepository);

$status = $userService->auth('user1', '12345');

print_r($status);

if ($status === 'OK') {
    $user = $userService->getUser(23);
    print_r($user);
}
