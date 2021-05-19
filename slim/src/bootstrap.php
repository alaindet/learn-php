<?php

use Slim\Factory\AppFactory;

use App\Core\Exceptions\ExceptionHandler;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(ExceptionHandler::class);

require __DIR__ . '/routes.php';

$app->run();