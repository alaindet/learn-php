<?php

use App\Helpers\Headers;
use App\Features\Users\Services\UsersService;
use App\Features\Users\Dtos\CreateUserDto;

require __DIR__ . "./src/bootstrap.php";

Headers::setCors($origin = "localhost");
Headers::setContentType();

try {
    $requestBody = json_decode(file_get_contents("php://input"));

    $dto = new CreateUserDto();
    $dto->first_name = $requestBody->first_name;
    $dto->last_name = $requestBody->last_name;
    $dto->email = $requestBody->email;
    $dto->password = $requestBody->password;

    UsersService::createUser($dto);

    http_response_code(200);
    echo json_encode([
        "data" => null,
        "meta" => [
            "error" => false,
            "message" => "User registered",
        ],
    ]);
}

catch (\Exception $e) {
    http_response_code(400);
    echo json_encode([
        "data" => null,
        "meta" => [
            "error" => true,
            "message" => $e->getMessage(),
        ],
    ]);
}
