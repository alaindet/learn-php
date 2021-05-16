<?php

namespace App\Features\Users\Services;

use App\Features\Users\Dtos\CreateUserDto;
use App\Features\Users\Repositories\UsersRepository;

class UsersService {

    static public function createUser(CreateUserDto $dto): void
    {
        $repo = new UsersRepository();

        if ($repo->emailExists($dto->email)) {
            $message = "User with email {$dto->email} already exists";
            throw new \Exception($message);
        }

        $repo->createUser($dto);
    }
}
