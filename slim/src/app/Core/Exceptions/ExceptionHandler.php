<?php

namespace App\Core\Exceptions;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;
use Slim\Exception\HttpNotFoundException;

use App\Core\Exceptions\HttpException;

class ExceptionHandler {
    public function __invoke(
        ServerRequestInterface $request,
        \Throwable $exception
    ): Response
    {
        $status = 500;

        if ($exception instanceof HttpException) {
            $status = $exception->getStatusCode();
        } elseif ($exception instanceof HttpNotFoundException) {
            $status = 404;
        }

        $payloadData = [
            'error' => true,
            'message' => $exception->getMessage(),
        ];

        $payload = json_encode($payloadData, JSON_UNESCAPED_UNICODE);

        $response = new Response();
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
