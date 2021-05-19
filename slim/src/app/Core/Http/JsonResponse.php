<?php

namespace App\Core\Http;

use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

abstract class JsonResponse
{
    static public function create(
        ResponseInterface $response,
        int $statusCode,
        $data
    ): ResponseInterface
    {
        $payload = json_encode($data, JSON_UNESCAPED_UNICODE);

        $response = new Response();
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($statusCode);
    }
}
