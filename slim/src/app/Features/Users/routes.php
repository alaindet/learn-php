<?php

use App\Features\Users\Actions\LoginUserAction;
use App\Features\Users\Actions\RegisterUserAction;

$app->post('/users/login', LoginUserAction::class);
$app->post('/users/register', RegisterUserAction::class);
