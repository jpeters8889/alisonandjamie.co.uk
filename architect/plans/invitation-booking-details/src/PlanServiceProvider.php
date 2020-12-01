<?php

namespace App\Architect\Plans\InvitationBookingDetails;

use JPeters\Architect\Architect;
use Illuminate\Support\ServiceProvider;

class PlanServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Architect::isRunning(function () {
            /** @var Architect $architect */
            $architect = Architect::getInstance();

            $architect->apiManager->registerEndpoint('get', 'invitation', ApiHandler::class, 'booking');
            $architect->assetManager->registerScript('InvitationBookingDetails', __DIR__.'/../dist/plan.js');
            $architect->assetManager->registerStyle('InvitationBookingDetails', __DIR__.'/../dist/plan.css');
        });
    }
}
