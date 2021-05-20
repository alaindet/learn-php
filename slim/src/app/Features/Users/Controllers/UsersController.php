<?php

namespace App\Features\Users\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Core\Http\JsonResponse;
use App\Features\Users\Dtos\CreateUserDto;
use App\Features\Users\Services\UsersService;

class UsersController
{
    public function login(Request $request, Response $response): Response
    {
        return JsonResponse::from($response->withStatus(200), [
            'message' => 'User authenticated'
        ]);
    }

    public function register(Request $request, Response $response): Response
    {
        $requestBody = $request->getParsedBody();

        // TODO: Validate body

        $dto = new CreateUserDto();
        $dto->displayName = $requestBody['displayName'];
        $dto->username = $requestBody['username'];
        $dto->email = $requestBody['email'];
        $dto->password = $requestBody['password'];

        UsersService::createUser($dto);

        return JsonResponse::from($response->withStatus(201), [
            'error' => false,
            'message' => 'User registered',
        ]);
    }
}
