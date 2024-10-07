<?php 

use PHPUnit\Framework\TestCase;
use Src\Repository\UserRepository;
use Src\Service\UserService;

class UserAuthTest extends TestCase
{
    public function testAuthSuccess()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("auth")->willReturn([
            "status" => "OK",
            "token" => "qwaeafabajsjsjsjsjsjs"
        ]);

        $userService = new UserService($mock);
        $user = $userService->auth("user1", "12345");

        $this->assertIsString($user);

        $this->assertEquals(json_encode([
            "status" => "OK",
            "token" => "qwaeafabajsjsjsjsjsjs"
        ]), $user);
    }

    public function testAuthUserNotFound()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("auth")->willReturn(["status" => "Not found"]);

        $userService = new UserService($mock);
        $user = $userService->auth("john", "wrong_password");

        $this->assertIsString($user);

        $this->assertEquals(json_encode([
            "status" => "Not found"
        ]), $user);
    }

    public function testAuthUserError()
    {
        $mock = $this->createMock(UserRepository::class);
        $mock->method("auth")->willReturn(["status" => "Error"]);

        $userService = new UserService($mock);
        $user = $userService->auth("john", "");

        $this->assertIsString($user);

        $this->assertEquals(json_encode([
            "status" => "Error"
        ]), $user);
    }

}

