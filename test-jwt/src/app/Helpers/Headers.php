<?php

namespace App\Helpers;

class Headers {

    static public function setCors(
        $origin = "*",
        $methods = [
            "GET",
            "POST",
            "PUT",
            "DELETE"
        ],
        $cacheAge = 3600,
        $cacheHeaders = [
            "Content-Type",
            "Access-Control-Allow-Headers",
            "Authorization",
            "X-Requested-With"
        ]
    ): void
    {
        $methodsList = implode(", ", $methods);
        $cacheHeadersList = implode(", ", $cacheHeaders);

        header("Access-Control-Allow-Origin: {$origin}");
        header("Access-Control-Allow-Methods: {$methodsList}");
        header("Access-Control-Max-Age: {$cacheAge}");
        header("Access-Control-Allow-Headers: {$cacheHeadersList}");
    }

    static public function setContentType(
        $contentType = "application/json; charset=UTF-8"
    ): void
    {
        header("Content-Type: {$contentType}");
    }
}
