<?php

namespace App\Core\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class JsonResponseBodyMiddleware implements MiddlewareInterface
{
    public function process(
        Request $request,
        RequestHandler $handler
    ): ResponseInterface
    {
        $response = $handler->handle($request);
        // TODO
        $response->getBody()->write('REPLACED');
        return $response;
    }
}
