<?php

namespace App\Core\Exceptions;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;
use Slim\Exception\HttpNotFoundException;

use App\Core\Exceptions\HttpException;
use App\Core\Http\JsonResponse;

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

        return JsonResponse::create(new Response(), $status, [
            'error' => true,
            'message' => $exception->getMessage(),
        ]);
    }
}
