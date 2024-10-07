<?php

require __DIR__ . '/vendor/autoload.php';

use Src\Factory\UserFactory;
use Src\Service\UserService;

$userRepository = UserFactory::createRepository();
$userService = new UserService($userRepository);

$status = $userService->auth('user', '12345');

print_r($status);
