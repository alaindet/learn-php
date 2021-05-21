<?php

namespace App\Features\Users\Services;

use Firebase\JWT\JWT;

use App\Core\Exceptions\HttpExceptionFactory;
use App\Features\Users\Dtos\CreateUserDto;
use App\Features\Users\Dtos\AuthenticateUserDto;
use App\Features\Users\Dtos\AuthenticatedUserDto;
use App\Features\Users\Repositories\UsersRepository;

class UsersService
{
    static public function createUser(CreateUserDto $dto): void
    {
        $repo = new UsersRepository();

        if ($repo->findUserByEmail($dto->email) !== null) {
            $message = "User with email {$dto->email} already exists";
            throw HttpExceptionFactory::conflict($message);
        }

        $repo->createUser($dto);
    }

    static public function authenticateUser(
        AuthenticateUserDto $dtoIn
    ): AuthenticatedUserDto
    {
        $repo = new UsersRepository();

        $user = $repo->findUserByEmail($dtoIn->email);

        if (
            $user === null ||
            !password_verify($dtoIn->password, $user->password)
        ) {
            $message = 'Wrong email and/or password';
            throw HttpExceptionFactory::unauthorized($message);
        }

        $issuerClaim = APP_JWT_ISSUER;
        $subjectClaim = $user->id; // TODO: Could be auth session ID
        $issuedAtClaim = time();
        $expiresInClaim = $issuedAtClaim + 3600; // An hour
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

    static public function checkUserToken(?string $authHeader): array
    {
        try {
            [$bearer, $token] = explode(" ", $authHeader);
            return (array) JWT::decode($token, APP_JWT_SECRET, ['HS256']);
        } catch (\Exception $e) {
            throw new \Exception("Invalid or missing authorization token");
        }
    }
}
