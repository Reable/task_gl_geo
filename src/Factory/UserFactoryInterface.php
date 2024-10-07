<?php 

namespace Src\Factory;

use Src\Repository\UserRepository;

interface UserFactoryInterface {
    public static function createRepository(): UserRepository;
}