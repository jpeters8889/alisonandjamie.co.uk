<?php

namespace App\Architect\Plans\InvitationNames;

use Illuminate\Database\Eloquent\Model;
use JPeters\Architect\Plans\Plan as ArchitectPlan;

class Plan extends ArchitectPlan
{
    public function vuePrefix(): string
    {
        return 'invitation-names';
    }

    public function handleUpdate(Model $model, $column, $value)
    {
        $model->$column = explode(',', $value);
    }
}
