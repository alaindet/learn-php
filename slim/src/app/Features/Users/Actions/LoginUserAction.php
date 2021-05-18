<?php

namespace App\Features\Users\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoginUserAction {
    public function __invoke(Request $request, Response $response): Response {
        $response->getBody()->write('LoginUserAction');
        return $response;
    }
}
