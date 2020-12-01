<?php

namespace App\Architect\Plans\InvitationNames;

use JPeters\Architect\Architect;
use Illuminate\Support\ServiceProvider;

class PlanServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Architect::isRunning(function () {
            /** @var Architect $architect */
            $architect = Architect::getInstance();

            $architect->apiManager->registerEndpoint('post', 'wedding-invitation-names', ApiHandler::class);
            $architect->assetManager->registerScript('InvitationNames', __DIR__.'/../dist/plan.js');
            $architect->assetManager->registerStyle('InvitationNames', __DIR__.'/../dist/plan.css');
        });
    }
}
