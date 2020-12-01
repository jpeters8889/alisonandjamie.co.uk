<?php

namespace App\Providers;

use App\Architect\InvitationsBlueprint;
use App\Architect\UserBlueprint;
use JPeters\Architect\Dashboards\Dashboard;
use JPeters\Architect\Providers\ArchitectApplicationServiceProvider;

class ArchitectServiceProvider extends ArchitectApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function blueprints(): array
    {
        return [
            InvitationsBlueprint::class,
            UserBlueprint::class,
        ];
    }

    public function dashboards(): array
    {
        return [
            Dashboard::class,
        ];
    }
}
