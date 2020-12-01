<?php

namespace App\Architect\Plans\InvitationBookingDetails;

use Illuminate\Database\Eloquent\Model;
use JPeters\Architect\Plans\Plan as ArchitectPlan;

class Plan extends ArchitectPlan
{
    protected bool $showOnForm = false;

    public function vuePrefix(): string
    {
        return 'invitation-booking-details';
    }

    public function handleUpdate(Model $model, $column, $value)
    {
        //
    }

    public function getCurrentValue(Model $model)
    {
       //
    }

    public function hasDatabaseColumn(): bool
    {
        return false;
    }
}
