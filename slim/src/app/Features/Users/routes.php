<?php

use App\Features\Users\Controllers\UsersController;
use App\Core\Middlewares\JsonBodyParserMiddleware;

$app
    ->post('/users/login', UsersController::class.':login')
    ->add(JsonBodyParserMiddleware::class);


$app
    ->post('/users/register', UsersController::class.':register')
    ->add(JsonBodyParserMiddleware::class);
