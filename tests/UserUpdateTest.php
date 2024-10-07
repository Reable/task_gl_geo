<?php 

use PHPUnit\Framework\TestCase;
use Src\Repository\UserRepository;
use Src\Service\UserService;

class UserUpdateTest extends TestCase
{
    public function testUpdateUserSuccess()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("updateUser")->willReturn([
            "status" => "OK", 
        ]);

        $userService = new UserService($mock);
        $user = $userService->updateUser(1, [
            "active" => "1", 
            "blocked" => true, 
            "name" => "Petr Petrovich", 
            "permissions" => [ 
                [ 
                    "id" => 1, 
                    "permission" => "comment" 
                ], 
            ] 
        ]);

        $this->assertIsString($user);

        $this->assertEquals(json_encode([
            "status" => "OK",
        ]), $user);
    }

    public function testUpdateUserError()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("updateUser")->willReturn([
            "status" => "Error"
        ]);

        $userService = new UserService($mock);
        $user = $userService->updateUser(1, [
            "name" => "' OR '1'='1'", 
        ]);

        $this->assertIsString($user);

        $this->assertEquals(json_encode([
            "status" => "Error",
        ]), $user);
    }

    public function testUpdateUserNotFound()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("updateUser")->willReturn([
            "status" => "Not found"
        ]);

        $userService = new UserService($mock);
        $user = $userService->updateUser(22, [
            "active" => "1", 
            "blocked" => true, 
            "name" => "Ivan Razmyslov", 
            "permissions" => [ 
                [ 
                    "id" => 1, 
                    "permission" => "comment" 
                ], 
            ] 
        ]);

        $this->assertIsString($user);

        $this->assertEquals(json_encode([
            "status" => "Not found",
        ]), $user);
    }

}

