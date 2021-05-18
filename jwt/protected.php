<?php

use App\Helpers\Headers;
use App\Features\Users\Services\UsersService;

require __DIR__ . "./src/bootstrap.php";

Headers::setCors($origin = "localhost");
Headers::setContentType();

try {

    $data = UsersService::checkUserToken($_SERVER['HTTP_AUTHORIZATION']);

    $response = json_encode([
        "data" => $data,
        "meta" => [
            "error" => false,
            "message" => "Protected route accessed",  
        ],
    ]);

    http_response_code(200);
    echo $response;
}

catch (\Exception $e) {

    $response = json_encode([
        "data" => null,
        "meta" => [
            "error" => true,
            "message" => $e->getMessage(),
        ],
    ]);

    http_response_code(401);
    echo $response;
}
