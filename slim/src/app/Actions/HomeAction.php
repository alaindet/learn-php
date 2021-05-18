<?php

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeAction {
    public function __invoke(Request $request, Response $response): Response {
        $response->getBody()->write('Hello world!');
        return $response;
    }
}
