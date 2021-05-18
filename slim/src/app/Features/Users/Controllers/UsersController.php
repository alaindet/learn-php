<?php

namespace App\Features\Users\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class UsersController {

    public function login(Request $request, Response $response): Response
    {
        // Move to middleware
        $contentType = $request->getHeaderLine('Content-Type');
        if (!strstr($contentType, 'application/json')) {
            return $response->getBody()->write('ERROR: WRONG CONTENT TYPE');
        }

        $parsedBody = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $response->getBody()->write('ERROR: INVALID JSON');
        }

        $request = $request->withParsedBody($parsedBody);


    }

    public function register(Request $request, Response $response): Response
    {
        $response->getBody()->write('register');
        return $response;
    }
}
