<?php

use Slim\Routing\RouteCollectorProxy as RouteGroup;

use App\Features\Users\Controllers\UsersController;
use App\Core\Middlewares\JsonRequestBodyMiddleware;
use App\Core\Middlewares\JsonResponseBodyMiddleware;

$usersRoutes = function(RouteGroup $group)
{
    $group->post('/login', UsersController::class . ':login');
    $group->post('/register', UsersController::class . ':register');
};

$app
    ->group('/users', $usersRoutes)
    ->add(JsonRequestBodyMiddleware::class)
    ->add(JsonResponseBodyMiddleware::class);
