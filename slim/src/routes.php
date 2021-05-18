<?php

use App\Actions\HomeAction;

$app->get('/', HomeAction::class);

require __DIR__ . '/app/Features/Users/routes.php';
