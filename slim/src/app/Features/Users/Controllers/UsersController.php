<?php

namespace App\Features\Users\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Core\Http\JsonResponse;

class UsersController {

    public function login(Request $request, Response $response): Response
    {
        return JsonResponse::create($response, 200, [
            'message' => 'User authenticated'
        ]);
    }

    public function register(Request $request, Response $response): Response
    {
        return JsonResponse::create($response, 201, [
            'message' => 'User registered'
        ]);
    }
}
