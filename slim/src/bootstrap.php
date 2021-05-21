<?php

use Slim\Factory\AppFactory;

use App\Core\Exceptions\ExceptionHandler;

// Declare .env vars as constants
$config = require __DIR__ . './config.php';

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler(ExceptionHandler::class);

require __DIR__ . '/routes.php';

$app->run();
