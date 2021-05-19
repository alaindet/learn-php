<?php

namespace App\Features\Users\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersController {

    public function login(Request $request, Response $response): Response
    {
        $response->getBody()->write('login');
        return $response;
    }

    public function register(Request $request, Response $response): Response
    {
        $response->getBody()->write('register');
        return $response;
    }
}
