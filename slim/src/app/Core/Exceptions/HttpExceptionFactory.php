<?php

namespace App\Core\Exceptions;

abstract class HttpExceptionFactory
{
    static public function badRequest(string $message): HttpException
    {
        return new HttpException(400, $message);
    }

    static public function notFound(string $message): HttpException
    {
        return new HttpException(404, $message);
    }

    static public function unsupportedMediaType(string $message): HttpException
    {
        return new HttpException(415, $message);
    }

    static public function conflict(string $message): HttpException
    {
        return new HttpException(409, $message);
    }
}
