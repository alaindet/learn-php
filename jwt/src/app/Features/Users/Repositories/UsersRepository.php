<?php

namespace App\Features\Users\Repositories;

use App\Features\Users\Dtos\CreateUserDto;
use App\Features\Users\Models\User;

class UsersRepository {

    public $path = __DIR__ . '/../data/users.json';
    public $data = [];

    public function __construct()
    {
        $this->loadData();
    }

    public function loadData(): void
    {
        $jsonContent = file_get_contents($this->path);
        $this->data = json_decode($jsonContent);
    }

    public function storeData(): void
    {
        $jsonContent = json_encode($this->data);
        file_put_contents($this->path, $jsonContent);
    }

    public function createUser(CreateUserDto $dto): void
    {
        $user = new User();
        $user->id = time();
        $user->first_name = $dto->first_name;
        $user->last_name = $dto->last_name;
        $user->email = $dto->email;
        $user->password = password_hash($dto->password, PASSWORD_BCRYPT);

        $this->data[] = $user;
        $this->storeData();
    }

    public function findUserByEmail(string $email): ?User
    {
       foreach ($this->data as $userData) {
            if ($userData->email === $email) {
                return $this->asUser($userData);
            }
        }
        
        return null;
    }

    public function asUser(object $data): User
    {
        $user = new User();
        $user->id = $data->id;
        $user->first_name = $data->first_name;
        $user->last_name = $data->last_name;
        $user->email = $data->email;
        $user->password = $data->password;

        return $user;
    }
}
