<?php

namespace App\Features\Users\Services;

use Firebase\JWT\JWT;

use App\Features\Users\Dtos\CreateUserDto;
use App\Features\Users\Dtos\AuthenticateUserDto;
use App\Features\Users\Dtos\AuthenticatedUserDto;
use App\Features\Users\Repositories\UsersRepository;

class UsersService {

    static public function createUser(CreateUserDto $dto): void
    {
        $repo = new UsersRepository();

        if ($repo->findUserByEmail($dto->email) !== null) {
            $message = "User with email {$dto->email} already exists";
            throw new \Exception($message);
        }

        $repo->createUser($dto);
    }

    static public function authenticateUser(
        AuthenticateUserDto $dtoIn
    ): AuthenticatedUserDto
    {
        $repo = new UsersRepository();

        $user = $repo->findUserByEmail($dtoIn->email);

        if ($user === null) {
            $message = "User with email {$dtoIn->email} does not exist";
            throw new \Exception($message);
        }

        if (!password_verify($dtoIn->password, $user->password)) {
            $message = "Wrong password";
            throw new \Exception($message);
        }

        $issuerClaim = APP_JWT_ISSUER;
        $subjectClaim = $user->id; // TODO: Could be auth session ID
        $issuedAtClaim = time();
        $expiresInClaim = $issuedAtClaim + 3600;
        $notBeforeClaim = $issuedAtClaim;

        $claims = [
            "iss" => $issuerClaim,
            "sub" => $subjectClaim,
            "exp" => $expiresInClaim,
            "nbf" => $notBeforeClaim,
            "iat" => $issuedAtClaim,
        ];

        $jwt = JWT::encode($claims, APP_JWT_SECRET);

        $dtoOut = new AuthenticatedUserDto();
        $dtoOut->email = $dtoIn->email;
        $dtoOut->jwt = $jwt;
        $dtoOut->expireAt = $expiresInClaim;

        return $dtoOut;
    }
}
