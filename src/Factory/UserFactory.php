<?php 

namespace Src\Factory;

use GuzzleHttp\Client;
use Src\Repository\UserRepository;

class UserFactory {
    public static function createRepository() {
        $client = new Client();
        return new UserRepository($client);
    }
}