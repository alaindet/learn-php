<?php

use App\Features\Users\Controllers\UsersController;
use App\Core\Middlewares\JsonRequestBodyMiddleware;
use App\Core\Middlewares\AuthenticationMiddleware;

$app->post('/users/login', UsersController::class . ':login')
    ->add(JsonRequestBodyMiddleware::class);

$app->post('/users/register', UsersController::class . ':register')
    ->add(JsonRequestBodyMiddleware::class);

$app->get('/users/list', UsersController::class . ':list')
    ->add(AuthenticationMiddleware::class);
