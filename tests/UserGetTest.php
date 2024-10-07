<?php 

use PHPUnit\Framework\TestCase;
use Src\Repository\UserRepository;
use Src\Service\UserService;

class UserGetTest extends TestCase
{
    public function testGetUserSuccess()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("getUser")->willReturn([
            "status" => "OK", 
            "active" => "1", 
            "blocked" => false, 
            "created_at" => 1587457590, 
            "id" => 23, 
            "name" => "Ivanov Ivan", 
            "permissions" => [ 
                [ 
                    "id" => 1, 
                    "permission" => "comment" 
                ], 
                [ 
                    "id" => 2, 
                    "permission" => "upload photo" 
                ], 
                [ 
                    "id" => 3, 
                    "permission" => "add event" 
                ] 
            ] 
        ]);

        $userService = new UserService($mock);
        $user = $userService->getUser(1);

        $this->assertIsString($user);

        $this->assertEquals(json_encode([
            "status" => "OK", 
            "active" => "1", 
            "blocked" => false, 
            "created_at" => 1587457590, 
            "id" => 23, 
            "name" => "Ivanov Ivan", 
            "permissions" => [ 
                [ 
                    "id" => 1, 
                    "permission" => "comment" 
                ], 
                [ 
                    "id" => 2, 
                    "permission" => "upload photo" 
                ], 
                [ 
                    "id" => 3, 
                    "permission" => "add event" 
                ] 
            ] 
        ]), $user);
    }

    public function testGetUserError()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("getUser")->willReturn([
            "status" => "Error"
        ]);

        $userService = new UserService($mock);
        $user = $userService->getUser(-11);

        $this->assertIsString($user);
        
        $this->assertEquals(json_encode([
            "status" => "Error"
        ]), $user);
    }

    public function testGetUserNotFound()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("getUser")->willReturn([
            "status" => "Not found"
        ]);

        $userService = new UserService($mock);
        $user = $userService->getUser(22);

        $this->assertIsString($user);

        $this->assertEquals(json_encode([
            "status" => "Not found"
        ]), $user);
    }

}

