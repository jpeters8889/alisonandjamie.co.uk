<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Container\Container;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        /** @var Router $router */
        $router = Container::getInstance()->make(Router::class);

        /** @phpstan-ignore-next-line  */
        $router->middleware('web')->group(function () use ($router) {
            require base_path('routes/web.php');
        });
    }
}
