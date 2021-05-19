<?php

use App\Features\Users\Controllers\UsersController;
use App\Core\Middlewares\JsonRequestBodyMiddleware;

$app
    ->post('/users/login', UsersController::class.':login')
    // TODO: Use middleware group
    ->add(JsonRequestBodyMiddleware::class);


$app
    ->post('/users/register', UsersController::class.':register')
    ->add(JsonRequestBodyMiddleware::class);
