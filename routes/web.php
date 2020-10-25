<?php

declare(strict_types=1);

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\QAndAController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\RsvpThanksController;
use App\Http\Controllers\ThanksToController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\VenuesController;
use Illuminate\Routing\Router;

/* @var Router $router */

$router->get('/', [HomeController::class, 'get']);
$router->get('/venues-and-schedule', [VenuesController::class, 'get']);
$router->get('/travel-and-accommodation', [TravelController::class, 'get']);
$router->get('/q-and-a', [QAndAController::class, 'get']);
$router->get('/rsvp', [RsvpController::class, 'get']);
$router->get('/rsvp/thanks', [RsvpThanksController::class, 'get']);
$router->get('/thanks-to', [ThanksToController::class, 'get']);

$router->group(['prefix' => '/api'], static function ($router) {
    $router->group(['prefix' => '/invitation'], static function ($router) {
        $router->post('/', [InvitationController::class, 'get']);
    });

    $router->group(['prefix' => '/bookings'], static function ($router) {
        $router->post('/', [BookingController::class, 'create']);
    });
});
