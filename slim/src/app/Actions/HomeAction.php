<?php

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeAction {
    public function __invoke(Request $req, Response $res): Response {
        $res->getBody()->write('Hello world!');
        return $res;
    }
}
