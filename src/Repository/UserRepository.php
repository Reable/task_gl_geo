<?php 

namespace Src\Repository;

use Exception;
use GuzzleHttp\Client;
use Src\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    private $client;
    private $token;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function auth(string $login, string $password): array
    {
        try {
            $response = $this->client->post('http://testapi.ru/auth', [
                'data' => ['login' => $login, 'pass' => $password]
            ]);
            $data = json_decode($response->getBody(), true);
            
            if ($data['status'] === 'OK') {
                $this->token = $data['token'];
            }

            if ($data['status'] === 'Not found') {
                return [
                    "status" => $data['status'],
                ];
            }

            return [
                "status" => $data['status'],
                "token" => $data["token"]
            ];
        } catch (Exception $e) {
            return [
                "status" => "Error"
            ];
        }
    }

    public function getUser(int $userId): array
    {
        try {
            $response = $this->client->get("http://testapi.ru/get-user/$userId/?token={$this->token}");

            $data = json_decode($response->getBody(), true);

            if ($data['status'] === 'Not found') {
                return [
                    "status" => $data['status'],
                ];
            }

            return $data;
        } catch (Exception $e) {
            return [
                "status" => "Error"
            ];;
        }
    }

    public function updateUser(int $userId, array $data): array
    {
        try {
            $response = $this->client->post("http://testapi.ru/user/update?token={$this->token}", [
                'data' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return [
                "status" => "Error"
            ];
        }
    }

}