<?php

namespace App\Features\Users\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Core\Http\JsonResponse;
use App\Features\Users\Dtos\CreateUserDto;
use App\Features\Users\Dtos\AuthenticateUserDto;
use App\Features\Users\Repositories\UsersRepository;
use App\Features\Users\Services\UsersService;

class UsersController
{
    public function login(Request $request, Response $response): Response
    {
        $requestBody = $request->getParsedBody();

        // TODO: Validate body

        $dtoIn = new AuthenticateUserDto();
        $dtoIn->email = $requestBody->email;
        $dtoIn->password = $requestBody->password;

        $dtoOut = UsersService::authenticateUser($dtoIn);

        return JsonResponse::from($response->withStatus(200), [
            'data' => $dtoOut,
            'message' => 'User authenticated'
        ]);
    }

    public function register(Request $request, Response $response): Response
    {
        $requestBody = $request->getParsedBody();

        // TODO: Validate body

        $dto = new CreateUserDto();
        $dto->displayName = $requestBody->displayName;
        $dto->email = $requestBody->email;
        $dto->password = $requestBody->password;

        UsersService::createUser($dto);

        return JsonResponse::from($response->withStatus(201), [
            'message' => 'User registered',
        ]);
    }

    public function list(Request $request, Response $response): Response
    {
        $jwt = $request->getAttribute('jwt');

        $repo = new UsersRepository();
        $user = $repo->findUserById($jwt->sub);

        return JsonResponse::from($response->withStatus(200), [
            'message' => "Here is the users secret list requested by {$user->display_name}",
        ]);
    }
}
