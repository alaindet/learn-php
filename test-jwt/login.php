<?php

use App\Helpers\Headers;
use App\Features\Users\Services\UsersService;
use App\Features\Users\Dtos\AuthenticateUserDto;

require __DIR__ . "./src/bootstrap.php";

Headers::setCors($origin = "localhost");
Headers::setContentType();

try {
    $requestBody = json_decode(file_get_contents("php://input"));

    $dtoIn = new AuthenticateUserDto();
    $dtoIn->email = $requestBody->email;
    $dtoIn->password = $requestBody->password;

    $dtoOut = (array) UsersService::authenticateUser($dtoIn);

    $response = json_encode([
        "data" => $dtoOut,
        "meta" => [
          "error" => false,
            "message" => "User logged in",  
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

    http_response_code(400);
    echo $response;
}
