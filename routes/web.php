<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\VenuesController;
use Illuminate\Routing\Router;

/* @var Router $router */

$router->get('/', [HomeController::class, 'get']);
$router->get('/venues-and-schedule', [VenuesController::class, 'get']);
$router->get('/travel-and-accommodation', [TravelController::class, 'get']);
